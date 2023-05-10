<?php

namespace App\Actions\Item;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;

class FilterItems
{
    protected Builder $query;

    public function __construct(Item $model)
    {
        $this->query = $model->newQuery();
    }

    public function execute(array $params = []): Builder
    {
        return $this->query;
    }
}
