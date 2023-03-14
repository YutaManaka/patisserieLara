<?php

namespace App\Actions\Config;

use Illuminate\Database\Eloquent\Builder;

class GetConfigs
{
    public function __construct(private FilterConfigs $filter)
    {
    }

    public function execute(array $params = [], string $sort = 'description', string $order = 'asc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
