<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;

class DeleteImage
{
    public function execute(?string $imageUrl): bool
    {
        if (app()->environment() === 'production') {
            $s3 = Storage::disk('s3');
            // ファイルがあれば削除
            if ($imageUrl && $s3->exists($imageUrl)) {
                return $s3->delete($imageUrl);
            }
        } else {
            // ローカルの処理
            Storage::delete(str_replace('/storage', 'public', $imageUrl));
        }

        return true;
    }
}
