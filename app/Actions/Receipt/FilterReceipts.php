<?php

namespace App\Actions\Receipt;

use App\Models\Receipt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;

class FilterReceipts
{
    protected Builder $query;

    public function __construct(Receipt $model)
    {
        $this->query = $model->newQuery();
    }

    public function execute(array $params = []): Builder
    {
        if ($date = Arr::pull($params, 'date')) {
            $this->query
                ->whereDate('created_at', '>=', Date::make($date)->format('Y-m-d 00:00:00'))
                ->whereDate('created_at', '<=', Date::make($date)->format('Y-m-d 23:59:59'));
        }

        return $this->query;
    }
}
