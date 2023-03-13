<?php

namespace App\Actions\Config;

use App\Models\Config;
use Illuminate\Database\Eloquent\Builder;

class FilterConfigs
{
    protected Builder $query;

    public function __construct(Config $model)
    {
        $this->query = $model->newQuery();
    }

    public function execute(array $params = []): Builder
    {
        return $this->query;
    }
}
