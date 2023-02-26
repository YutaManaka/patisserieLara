<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class StoreUser
{
    public function execute(array $attributes): User
    {
        $attributes['password'] = Hash::make(Arr::pull($attributes, 'new_password'));

        return User::create($attributes);
    }
}
