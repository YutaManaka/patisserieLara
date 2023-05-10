<?php

namespace App\Actions\Item;

use App\Models\Item;

class StoreItem
{
    public function execute(array $attributes): Item
    {
        return Item::create($attributes);
    }
}
