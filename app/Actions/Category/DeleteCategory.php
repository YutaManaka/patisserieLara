<?php

namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategory
{
    public function execute(Category $model): bool
    {
        return (bool) $model->delete();
    }
}
