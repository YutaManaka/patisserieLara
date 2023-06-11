<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class StoreCategory
{
    public function __construct(private StoreCategoryImage $storeImageAction)
    {
    }

    public function execute(array $attributes = [], $file = null): Category
    {
        DB::beginTransaction();
        $category = Category::create($attributes);

        if ($file) {
            $this->storeImageAction->execute($category, $file);
        }
        DB::commit();

        return $category;
    }
}
