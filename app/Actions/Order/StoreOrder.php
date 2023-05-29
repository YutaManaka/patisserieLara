<?php

namespace App\Actions\Order;

use App\Models\Order;

class StoreOrder
{
    public function execute(array $attributes): Order
    {
        return Order::create($attributes);
    }
}
