<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;

class DeleteImage
{
    public function execute(?string $imageUrl): bool
    {
        // ローカルの処理
        Storage::delete(str_replace('/storage', 'public', $imageUrl));

        return true;
    }
}
