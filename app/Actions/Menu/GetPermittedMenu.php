<?php

namespace App\Actions\Menu;

use App\Models\User;

class GetPermittedMenu
{
    public function execute(User $user): array
    {
        $allRoutes = app(GetAllMenu::class)->execute();
        foreach ($allRoutes as $key => $route) {
            foreach ($route['items'] as $itemKey => $item) {
                // 「ROOTではない+項目のpermissionsに記載されていない」場合、項目を非表示にする
                if (!$user->permission === User::PERMISSION_ROOT && !in_array($user->permission, $item['permissions'])) {
                    unset($allRoutes[$key]['items'][$itemKey]);
                }
            }
            if (!count($allRoutes[$key]['items'])) {
                unset($allRoutes[$key]);
            }
        }

        return $allRoutes;
    }
}
