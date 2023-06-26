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

        if (app()->environment() === 'production') {
            // バケット内の指定フォルダへアップロード
            $s3 = Storage::disk('s3')->putFile('/categories', $file, 'public');

            // アップロードファイルurlを取得
            $path = Storage::disk('s3')->url($s3);
        } else {
            $path     = Storage::put('public/images/', $file);
            $fileName = ltrim($path, 'public/images//');

            // モデルにパスを保存
            $path = "/storage/images/{$fileName}";
        }

        $category->update(['img_url' => $path]);

        return $category;
    }
}
