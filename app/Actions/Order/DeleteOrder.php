<?php

namespace App\Actions\Order;

use App\Models\Order;

class DeleteOrder
{
    public function execute(Order $model): bool
    {
        return (bool) $model->delete();
    }
}
