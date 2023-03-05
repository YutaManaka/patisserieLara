<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class UpdateCategory
{
    // public function __construct(StoreCategoryImage $storeImageAction)
    // {
    // }

    public function execute(Category $category, array $attributes = [], $file = null): Category
    {
        DB::beginTransaction();
        $category->update($attributes);
        // TODO: 画像保存処理
        // if ($file) {
        //     $this->storeImageAction->execute($category, $file);
        // }
        DB::commit();

        return $category->refresh();
    }
}
