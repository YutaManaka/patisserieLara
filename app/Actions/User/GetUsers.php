<?php

namespace App\Actions\User;

use Illuminate\Database\Eloquent\Builder;

class GetUsers
{
    public function __construct( private FilterUsers $filter)
    {
    }

    public function execute(array $params = [], string $sort = 'id', string $order = 'desc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
