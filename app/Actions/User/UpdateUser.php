<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    public function execute(User $model, array $attributes): User
    {
        if (Arr::pull($attributes, 'change_password')) {
            $attributes['password'] = Hash::make(Arr::pull($attributes, 'new_password'));
        }
        $model->update($attributes);

        return $model->refresh();
    }
}
