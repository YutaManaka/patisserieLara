<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ITEM_LABELS = [
        'index_title'  => '商品一覧',
        'form_title'   => '商品詳細',
        'description'  => '商品説明',
        'disabled'     => '非表示にする',
        'category_ids' => '表示するカテゴリ',
    ];

    protected $fillable = [
        'code',
        'img_url',
        'name',
        'receipt_name',
        'description',
        'price',
        'tax',
        'tax_excluded_price',
        'sort_order',
        'disabled',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item', 'item_id', 'category_id');
    }

    // TODO: image_urlの取得
    public function getImageUrlAttribute()
    {
        $url = $this->attributes['img_url'] ?? null;
        if (!$url) {
            return '/images/dummy-item-image.png';
        }

        return $url;
        // return Str::startsWith($url, 'http')
        //     ? $url
        //     : Storage::disk('s3')->url($url);
    }
}
