<?php

namespace App\Actions\Item;

use App\Models\Item;
use Illuminate\Support\Collection;

class GetUncategorizedItems
{
    public function execute(): Collection
    {
        return Item::query()
            ->doesntHave('categories')
            ->get();
    }
}
