<?php

namespace App\Http\Controllers;

use App\Actions\Menu\GetAllMenu;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function __construct(GetAllMenu $action)
    {
        $permissions = User::getPermissionNames();
        unset($permissions[User::PERMISSION_ROOT]);

        $transactionPermissions = Arr::get($action->execute(), 'table-order.items.transactions');

        Inertia::share([
            'permissions'            => $permissions,
            'transactionPermissions' => $transactionPermissions,
            'userLabels'             => User::USER_LABELS,
        ]);
    }

    public function index()
    {
        return Inertia::render(
            'User/Index',
            [
                'users' => User::get(),
            ]
        );
    }
}
