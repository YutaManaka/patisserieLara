<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * ユーザーを追加する。
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'       => 'root',
                'email'      => 'root@pl.com',
                'password'   => Hash::make('root'),
                'permission' => User::PERMISSION_ROOT,
            ],
            [
                'name'       => 'システム管理者',
                'email'      => 'system@pl.com',
                'password'   => Hash::make('system'),
                'permission' => User::PERMISSION_SYSTEM,
            ],
            [
                'name'       => '運用管理者',
                'email'      => 'admin@pl.com',
                'password'   => Hash::make('admin'),
                'permission' => User::PERMISSION_ADMIN,
            ],
            [
                'name'       => 'サンプル',
                'email'      => 'sample@pl.com',
                'password'   => Hash::make('sample'),
                'permission' => User::PERMISSION_ROOT,
            ],
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user)->exists()) {
                User::create($user);
            }
        }
    }
}
