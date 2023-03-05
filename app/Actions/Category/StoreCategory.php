<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class StoreCategory
{
    // public function __construct(StoreCategoryImage $storeImageAction)
    // {
    // }

    public function execute(array $attributes = [], $file = null): Category
    {
        DB::beginTransaction();
        $category = Category::create($attributes);
        // TODO: 画像保存処理
        // if ($file) {
        //     $this->storeImageAction->execute($category, $file);
        // }
        DB::commit();

        return $category;
    }
}
