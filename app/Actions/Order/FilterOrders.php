<?php

namespace App\Actions\Order;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class FilterOrders
{
    protected Builder $query;

    public function __construct(Order $model)
    {
        $this->query = $model->newQuery();
    }

    public function execute(array $params = []): Builder
    {
        if ($date = Arr::pull($params, 'date')) {
            $this->query->where('reserve_date', $date->format('Y-m-d'));
        }

        return $this->query;
    }
}
