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
                //     'route'       => 'management.transaction',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                // 'category' => [
                //     'name'        => 'カテゴリ',
                //     'route'       => 'management.category',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                // 'item' => [
                //     'name'        => '商品',
                //     'route'       => 'management.item',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                // 'option' => [
                //     'name'        => 'オプション',
                //     'route'       => 'management.option',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
                // 'receipt' => [
                //     'name'        => 'レシート',
                //     'route'       => 'management.receipt',
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
                // 'system-config' => [
                //     'name'        => '各種設定',
                //     'route'       => 'system-config',
                //     'permissions' => [
                //         User::PERMISSION_SYSTEM,
                //         User::PERMISSION_ADMIN,
                //     ],
                // ],
            ],
        ],
    ];

    public function execute(): array
    {
        return $this->menus;
    }
}
