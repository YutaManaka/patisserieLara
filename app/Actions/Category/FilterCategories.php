<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class FilterCategories
{
    protected Builder $query;

    public function __construct(Category $model)
    {
        $this->query = $model->newQuery();
    }

    public function execute(array $params = []): Builder
    {
        return $this->query;
    }
}
