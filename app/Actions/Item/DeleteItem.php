<?php

namespace App\Actions\Item;

use App\Models\Item;

class DeleteItem
{
    public function execute(Item $model): bool
    {
        return (bool) $model->delete();
    }
}
