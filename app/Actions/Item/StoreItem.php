<?php

namespace App\Actions\Item;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class StoreItem
{
    public function __construct(private StoreItemImage $storeItemImageAction)
    {
    }

    public function execute(array $attributes, $file = null): Item
    {
        DB::beginTransaction();

        $item = Item::create($attributes);

        if ($file) {
            $this->storeItemImageAction->execute($item, $file);
        }

        DB::commit();

        return $item;
    }
}
