<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;

class DeleteImage
{
    public function execute(?string $imageUrl): bool
    {
        // ローカルの処理
        Storage::delete(str_replace('/storage', 'public', $imageUrl));

        // TODO: s3の処理
        // $s3 = Storage::disk('s3');
        // // ファイルがあれば削除
        // if ($s3ImageUrl && $s3->exists($s3ImageUrl)) {
        //     return $s3->delete($s3ImageUrl);
        // }

        return true;
    }
}
