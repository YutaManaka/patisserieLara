<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithDb;

class UserTest extends TestCase
{
    use WithDb;
    use WithFaker;

    public function testFillable()
    {
        $attributes = [
            'name'     => '山田太郎',
            'email'    => 'hoge@example.co.jp',
            'password' => 'password',
        ];
        $user = User::create($attributes);
        $user->refresh();

        collect(collect($attributes))
            ->filter(fn ($val, $key) => $key !== 'password')
            ->each(fn ($val, $key) => $this->assertSame($val, $user->$key));
    }

    public function testDelete()
    {
        $user = User::factory()->create();

        $user->delete();
        $user->refresh();

        // findできない
        $this->assertNull(User::find($user->id));
    }
}
