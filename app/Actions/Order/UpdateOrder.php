<?php

namespace App\Actions\Order;

use App\Models\Order;

class UpdateOrder
{
    public function execute(Order $model, array $attributes): Order
    {
        $model->update($attributes);

        return $model->refresh();
    }
}
