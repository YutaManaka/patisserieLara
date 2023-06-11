<?php

namespace App\Actions\Item;

use App\Actions\Image\DeleteImage;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class StoreItemImage
{
    public function __construct(private DeleteImage $deleteAction)
    {
    }

    public function execute(Item $item, $file): Item
    {
        // すでにファイルがあれば削除
        $this->deleteAction->execute($item->img_url);

        $path     = Storage::put('public/images/', $file);
        $fileName = ltrim($path, 'public/images//');

        // モデルにパスを保存
        $item->update(['img_url' => "/storage/images/{$fileName}"]);

        return $item;
    }
}
