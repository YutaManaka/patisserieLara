<?php

namespace App\Actions\Item;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class UpdateItem
{
    public function __construct(private StoreItemImage $storeItemImageAction)
    {
    }

    public function execute(Item $item, array $attributes, $file = null): Item
    {
        DB::beginTransaction();

        $item->update($attributes);

        if ($file) {
            $this->storeItemImageAction->execute($item, $file);
        }
        DB::commit();

        return $item->refresh();
    }
}
