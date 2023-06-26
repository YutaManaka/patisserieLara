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

        if (app()->environment() === 'production') {
            // バケット内の指定フォルダへアップロード
            $s3 = Storage::disk('s3')->putFile('/items', $file, 'public');

            // アップロードファイルurlを取得
            $path = Storage::disk('s3')->url($s3);
        } else {
            $path     = Storage::put('public/images/', $file);
            $fileName = ltrim($path, 'public/images//');

            // モデルにパスを保存
            $path = "/storage/images/{$fileName}";
        }

        $item->update(['img_url' => $path]);

        return $item;
    }
}
