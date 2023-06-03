<?php

namespace App\Actions\Order;

class GetTotalPrice
{
    public function __construct(private FilterOrders $filter)
    {
    }

    public function execute(array $params = []): int
    {
        $orders = $this->filter
            ->execute($params)
            ->with('item')
            ->get();

        $totalPrice = 0;

        foreach ($orders as $order) {
            $totalPrice += $order->item->price * $order->quantity;
        }

        return $totalPrice;
    }
}
