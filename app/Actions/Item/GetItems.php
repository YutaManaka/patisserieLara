<?php

namespace App\Actions\Item;

use Illuminate\Database\Eloquent\Builder;

class GetItems
{
    public function __construct(private FilterItems $filter)
    {
    }

    public function execute(array $params = [], string $sort = 'id', string $order = 'desc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
