<?php

namespace App\Actions\Receipt;

use Illuminate\Database\Eloquent\Builder;

class GetReceipts
{
    public function __construct(
        private FilterReceipts $filter,
    ) {
    }

    public function execute(array $params = [], string $sort = 'id', string $order = 'asc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
