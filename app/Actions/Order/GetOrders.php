<?php

namespace App\Actions\Order;

use Illuminate\Database\Eloquent\Builder;

class GetOrders
{
    public function __construct(private FilterOrders $filter)
    {
    }

    public function execute(array $params = [], string $sort = 'id', string $order = 'desc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
