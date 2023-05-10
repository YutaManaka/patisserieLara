<?php

namespace App\Actions\Item;

use App\Models\Item;

class UpdateItem
{
    public function execute(Item $model, array $attributes): Item
    {
        $model->update($attributes);

        return $model->refresh();
    }
}
