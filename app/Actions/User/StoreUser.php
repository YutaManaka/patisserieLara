<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Arr;

class StoreUser
{
    public function execute(array $attributes): User
    {
        $attributes['password'] = Arr::pull($attributes, 'new_password');

        return User::create($attributes);
    }
}
