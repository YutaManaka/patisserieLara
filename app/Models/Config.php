<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ROUNDING_UP   = 0;
    public const ROUNDING_DOWN = 1;
    public const ROUNDING_OFF  = 2;

    public const CONFIG_LABELS = [
        'title'       => '各種設定',
        'description' => '項目名',
        'value'       => '値',
        'key'         => 'キー',
        'type'        => 'データ型',
    ];

    protected $primaryKey = 'key';
    public $incrementing  = false;
    public $timestamps    = true;

    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    protected $casts = [
        'value' => 'json',
    ];
}
