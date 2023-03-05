<?php

namespace App\Actions\Category;

use Illuminate\Database\Eloquent\Builder;

class GetCategories
{
    public function __construct(private FilterCategories $filter)
    {
    }

    public function execute(array $params = [], string $sort = 'sort_order', string $order = 'asc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
