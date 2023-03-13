<?php

namespace App\Actions\Config;

use Illuminate\Database\Eloquent\Builder;

class GetConfigs
{
    public function __construct(private FilterConfigs $filter)
    {
    }

    public function execute(array $params = [], string $sort = 'key', string $order = 'desc'): Builder
    {
        return $this->filter
            ->execute($params)
            ->orderBy($sort, $order);
    }
}
