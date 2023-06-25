<?php

namespace App\Actions\Order;

use App\Models\Order;

class SetOrdersDelivered
{
    public function execute(Order $order)
    {
        Order::query()
            ->where([
                'order_no'   => $order->order_no,
                'order_date' => now()->format('Y-m-d'),
            ])
            ->update(['delivered_at' => now()]);
    }
}
