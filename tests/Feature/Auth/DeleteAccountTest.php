<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testUserAccountsCanBeDeleted(): void
    {
        if (!Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');

            return;
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
    }

    public function testCorrectPasswordMustBeProvidedBeforeAccountCanBeDeleted(): void
    {
        if (!Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');

            return;
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($user->fresh());
    }
}
