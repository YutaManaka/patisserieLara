<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'root',
                'email' => 'root',
                'password' => 'root',
                'permission' => User::PERMISSION_ROOT,
            ],
            [
                'name' => 'システム管理者',
                'email' => 'system',
                'password' => 'system',
                'permission' => User::PERMISSION_SYSTEM,
            ],
            [
                'name' => '運用管理者',
                'email' => 'admin',
                'password' => 'admin',
                'permission' => User::PERMISSION_ADMIN,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
            // if (!User::where('email', $user)->exists()) {
            //     User::create($user);
            // }
        }
    }
}
