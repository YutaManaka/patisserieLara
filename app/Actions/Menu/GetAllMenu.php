<?php

namespace App\Actions\Menu;

use App\Models\User;

class GetAllMenu
{
    /**
     * @var array[]
     *              permissions はアクセス可能な User::PERMISSION_* 定数を指定。
     *              User::PERMISSION_ROOT は全て適用されるため書かなくて良い。
     */
    private array $menus = [
        'management' => [
            'name'  => '店舗管理',
            'items' => [
                // 'transaction' => [
                //     'name'        => '売上',
                //     'route'       => 'transaction',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                'category' => [
                    'name'        => 'カテゴリ',
                    'route'       => 'category',
                    'permissions' => [
                        User::PERMISSION_SYSTEM,
                        User::PERMISSION_ADMIN,
                    ],
                ],
                // 'item' => [
                //     'name'        => '商品',
                //     'route'       => 'item',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                // 'option' => [
                //     'name'        => 'オプション',
                //     'route'       => 'option',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                // 'receipt' => [
                //     'name'        => 'レシート',
                //     'route'       => 'receipt',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
            ],
        ],
        'settings' => [
            'name'  => '基本設定',
            'items' => [
                'user' => [
                    'name'        => 'アカウント',
                    'route'       => 'user',
                    'permissions' => [
                        User::PERMISSION_SYSTEM,
                    ],
                ],
                'config' => [
                    'name'        => '各種設定',
                    'route'       => 'config',
                    'permissions' => [
                        User::PERMISSION_SYSTEM,
                        User::PERMISSION_ADMIN,
                    ],
                ],
            ],
        ],
    ];

    public function execute(): array
    {
        return $this->menus;
    }
}
