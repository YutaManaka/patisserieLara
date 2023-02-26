<?php

namespace App\Http\Controllers;

use App\Actions\Menu\GetAllMenu;
use App\Actions\User\DeleteUser;
use App\Actions\User\GetUsers;
use App\Actions\User\StoreUser;
use App\Actions\User\UpdateUser;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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

    public function index(GetUsers $action)
    {
        $props = [
            'users' => $action->execute(
                ['exclude_permissions' => [User::PERMISSION_ROOT]]
            )->paginate(),
        ];

        return Inertia::render('User/Index', $props);
    }

    public function create()
    {
        return Inertia::render(
            'User/Form',
            ['isNew' => true]
        );
    }

    public function store(StoreUserRequest $request, StoreUser $action)
    {
        $action->execute($request->all());

        return Redirect::route('user')->with('success', '作成しました。');
    }

    public function show(User $user)
    {
        return Inertia::render(
            'User/Form',
            ['account' => $user]
        );
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUser $action)
    {
        $action->execute($user, $request->all());

        return Redirect::route('user')->with('success', '更新しました。');
    }

    public function destroy(User $user, DeleteUser $action)
    {
        $action->execute($user);

        return Redirect::route('user')->with('success', '削除しました。');
    }
}
