<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    private User $me;

    protected function setUp(): void
    {
        parent::setUp();
        $this->me = User::factory()->create();
        $this->actingAs($this->me);
    }

    public function test_resource_registers_all_seven_routes(): void
    {
        foreach (['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'] as $action) {
            $this->assertTrue(app('router')->has("users.$action"), "users.$action is missing");
        }
    }

    public function test_store_creates_user_with_hashed_password(): void
    {
        $this->post(route('users.store'), [
            'username' => 'newcashier',
            'full_name' => 'New Cashier',
            'email' => 'new@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('users.index'));

        $user = User::where('username', 'newcashier')->firstOrFail();
        $this->assertNotSame('password123', $user->password);
        $this->assertTrue(password_verify('password123', $user->password));
    }

    public function test_store_validates_unique_username(): void
    {
        $this->post(route('users.store'), [
            'username' => $this->me->username,
            'full_name' => 'Dup',
            'email' => 'dup@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertSessionHasErrors('username');
    }

    public function test_update_without_password_keeps_existing_password(): void
    {
        $user = User::factory()->create();
        $oldHash = $user->password;

        $this->put(route('users.update', $user), [
            'username' => $user->username,
            'full_name' => 'Renamed',
            'email' => $user->email,
        ])->assertRedirect(route('users.index'));

        $user->refresh();
        $this->assertSame('Renamed', $user->full_name);
        $this->assertSame($oldHash, $user->password);
    }

    public function test_destroy_deletes_other_user(): void
    {
        $user = User::factory()->create();

        $this->delete(route('users.destroy', $user))->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_user_cannot_delete_own_account_here(): void
    {
        $this->delete(route('users.destroy', $this->me))
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('users', ['id' => $this->me->id]);
    }
}
