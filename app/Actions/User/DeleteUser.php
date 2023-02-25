<?php

namespace App\Actions\User;

use App\Models\User;

class DeleteUser
{
    public function execute(User $model): bool
    {
        return (bool) $model->delete();
    }
}
