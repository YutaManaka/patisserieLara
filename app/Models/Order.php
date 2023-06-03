<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ORDER_LABELS = [
        'title'      => '注文状況',
        'delivered'  => '',
        'item_name'  => '商品名',
        'quantity'   => '数量',
        'item_price' => '単価(税込)',
        'created_at' => '注文日時',
        'receipt'    => '',
    ];

    protected $fillable = [
        'item_id',
        'receipt_id',
        'order_no',
        'sequence',
        'quantity',
        'order_date',
        'order_group_key',
        'delivered_at',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
