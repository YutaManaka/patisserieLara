<?php

namespace App\Actions\Order;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class StoreOrder
{
    public function execute(array $attributes): array
    {
        return DB::transaction(function () use ($attributes) {
            $today = now()->format('Y-m-d');
            // 注文番号
            $maxOrderNo = Order::query()
                ->where('order_date', $today)
                ->lockForUpdate()
                ->max('order_no');
            ++$maxOrderNo;

            $subtotal = 0;

            foreach ($attributes['items'] ?? [] as $key => $cartItem) {
                $item = Item::find($cartItem['item_id']);

                Order::create([
                    'item_id'         => $item->id,
                    'order_no'        => $maxOrderNo,
                    'sequence'        => $key + 1,
                    'quantity'        => $cartItem['quantity'],
                    'order_date'      => $today,
                    'order_group_key' => $cartItem['order_group_key'],
                ]);
                // 小計をに加算
                $subtotal += $item->price * $cartItem['quantity'];
            }

            return ['subtotal' => $subtotal];
        }, 5);
    }
}
