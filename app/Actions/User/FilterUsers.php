<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class FilterUsers
{
    protected Builder $query;

    public function __construct(User $model)
    {
        $this->query = $model->newQuery();
    }

    public function execute(array $params = []): Builder
    {
        if ($excludePermissions = Arr::pull($params, 'exclude_permissions')) {
            if (is_array($excludePermissions)) {
                $this->query->whereNotIn('permission', $excludePermissions);
            } else {
                $this->query->where('permission', '<>', $excludePermissions);
            }
        }

        return $this->query;
    }
}
