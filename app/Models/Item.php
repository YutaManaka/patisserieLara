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

    public const OPTION_LABELS = [
        'index_title' => '商品一覧',
        'form_title'  => '商品詳細',
        'disabled'    => '非表示',
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
        return $this->belongsToMany(TableOrderCategory::class, 'table_order_category_item', 'table_order_item_id', 'table_order_category_id');
    }

    // TODO: image_urlの取得
    public function getImageUrlAttribute()
    {
        $url = $this->attributes['image_url'] ?? null;
        if (!$url) {
            return '/images/dummy-item-image.png';
        }

        return Str::startsWith($url, 'http')
            ? $url
            : Storage::disk('s3')->url($url);
    }
}
