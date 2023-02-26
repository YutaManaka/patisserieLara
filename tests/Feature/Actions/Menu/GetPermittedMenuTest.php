<?php

namespace Tests\Feature\Actions\Menu;

use App\Actions\Menu\GetPermittedMenu;
use App\Models\User;
use Tests\TestCase;
use Tests\WithDb;

class GetPermittedMenuTest extends TestCase
{
    use WithDb;

    public function testAdminMenu()
    {
        $user = User::factory(['permission' => User::PERMISSION_SYSTEM])->create()->refresh();
        $menu = app(GetPermittedMenu::class)->execute($user);

        // $this->assertArrayHasKey('management', $menu);
        // $this->assertArrayHasKey('transaction', $menu['management']['items']);
        // $this->assertArrayHasKey('category', $menu['management']['items']);
        // $this->assertArrayHasKey('item', $menu['management']['items']);
        // $this->assertArrayHasKey('option', $menu['management']['items']);
        // $this->assertArrayHasKey('receipt', $menu['management']['items']);

        $this->assertArrayHasKey('settings', $menu);
        $this->assertArrayHasKey('user', $menu['settings']['items']);
        // $this->assertArrayHasKey('system-config', $menu['settings']['items']);
    }

    public function testTableOrderAdminMenu()
    {
        $user = User::factory(['permission' => User::PERMISSION_ADMIN])->create()->refresh();
        $menu = app(GetPermittedMenu::class)->execute($user);

        // $this->assertArrayHasKey('management', $menu);
        // $this->assertArrayHasKey('transaction', $menu['management']['items']);
        // $this->assertArrayHasKey('category', $menu['management']['items']);
        // $this->assertArrayHasKey('item', $menu['management']['items']);
        // $this->assertArrayHasKey('option', $menu['management']['items']);
        // $this->assertArrayHasKey('receipt', $menu['management']['items']);

        $this->assertArrayHasKey('settings', $menu);
        // $this->assertArrayHasKey('system-config', $menu['settings']['items']);
    }
}
