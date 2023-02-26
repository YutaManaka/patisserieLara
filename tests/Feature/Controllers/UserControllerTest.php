<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Tests\TestCase;
use Tests\WithDb;

class UserControllerTest extends TestCase
{
    use WithDb;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
    }

   public function testIndexUser()
   {
        $user2 = User::factory()->create();

        $response = $this->get(route('user'));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $this->user->name,
            $this->user->email,
            $this->user->permission,
            $user2->name,
            $user2->email,
            $user2->permission,
        ]);
   }

   public function testCreateUser()
   {
        $response = $this->get(route('user.create'));
        $response->assertStatus(200);
   }

   public function testStoreUser()
   {
        $data = [
            'name'         => 'storeTestName3',
            'email'        => 'storeTestEmail3',
            'permission'   => 80,
            'new_password' => 'storeTestPassword3',
        ];
        $response = $this->post(route('user.store'), $data);
        $response->assertStatus(302);
        $response->assertRedirect('users');

        $this->assertDatabaseHas(
            'users',
            [
                'name'         => 'storeTestName3',
                'email'        => 'storeTestEmail3',
                'permission'   => 80,
            ],
        );
        $user3 = User::where('name', 'storeTestName3')->first();
        $this->assertNotEquals('storeTestPassword3', $user3->password);
        $this->assertEquals(60, strlen($user3->password));
   }

   public function testShowUser()
   {
        $user4 = User::factory()->create();
        $response = $this->get(route('user.show', $user4->id));
        $response->assertStatus(200);
        $response->assertSeeInOrder([
            $user4->name,
            $user4->email,
            $user4->permission,
        ]);
   }

   public function testUpdateUser()
   {
    $user5 = User::factory()->create();
    $data = [
        'name'         => 'storeTestName5',
        'email'        => 'storeTestEmail5',
        'permission'   => 80,
    ];
    $response = $this->put(route('user.update', $user5->id), $data);
    $response->assertStatus(302);
    $response->assertRedirect('users');

    $this->assertDatabaseHas('users', $data);
   }

   public function testDestroyUser()
   {
        $user6 = User::factory()->create();
        $response = $this->delete(route('user.destroy', [ 'user' => $user6->id]));
        $response->assertStatus(200);

        // findできない
        $this->assertNull(User::find($user6->id));
   }
}
