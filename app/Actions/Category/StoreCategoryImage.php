<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class StoreCategoryImage
{
    public function execute(Category $category, $file): Category
    {
        $path     = Storage::put('public/images/', $file);
        $fileName = ltrim($path, 'public/images//');

        // モデルにパスを保存
        $category->update(['img_url' => "/storage/images/{$fileName}"]);

        return $category;
    }
}
