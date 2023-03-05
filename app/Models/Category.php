<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const CATEGORY_LABELS = [
        'index_title'      => 'カテゴリ一覧',
        'form_title'       => 'カテゴリ詳細',
        'name'             => 'カテゴリ名',
        'order_start_time' => '提供開始時間',
        'order_end_time'   => '提供終了時間',
        'sort_order'       => '表示順',
        'disabled'         => '表示/非表示',
    ];

    protected $fillable = [
        'name',
        'img_url',
        'order_start_time',
        'order_end_time',
        'sort_order',
        'disabled',
    ];

    protected $appends = ['image_url'];

    // TODO: itemとのリレーション
    // public function items()
    // {
    //     return $this->belongsToMany(Item::class, 'category_item');
    // }

    // TODO: image_urlの取得
    public function getImageUrlAttribute()
    {
        $url = $this->attributes['image_url'] ?? null;
        if (!$url) {
            return null;
        }

        return Str::startsWith($url, 'http')
            ? $url
            : Storage::disk('s3')->url($url);
    }
}
