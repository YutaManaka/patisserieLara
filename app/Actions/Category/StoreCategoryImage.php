<?php

namespace App\Actions\Category;

use App\Actions\Image\DeleteImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class StoreCategoryImage
{
    public function __construct(private DeleteImage $deleteAction)
    {
    }

    public function execute(Category $category, $file): Category
    {
        // すでにファイルがあれば削除
        $this->deleteAction->execute($category->img_url);

        $path     = Storage::put('public/images/', $file);
        $fileName = ltrim($path, 'public/images//');

        // モデルにパスを保存
        $category->update(['img_url' => "/storage/images/{$fileName}"]);

        return $category;
    }
}
