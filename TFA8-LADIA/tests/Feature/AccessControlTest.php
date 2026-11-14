<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Step 6 of the activity: logged-out visitors are redirected to the login
 * page, and the same routes work normally once logged in.
 */
class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    /** @return array<string, array{0: string, 1: string}> */
    public static function protectedGetRoutes(): array
    {
        return [
            'dashboard' => ['get', '/dashboard'],
            'customers index' => ['get', '/customers'],
            'customers create' => ['get', '/customers/create'],
            'customers show' => ['get', '/customers/1'],
            'customers edit' => ['get', '/customers/1/edit'],
            'users index' => ['get', '/users'],
            'users create' => ['get', '/users/create'],
            'users show' => ['get', '/users/1'],
            'users edit' => ['get', '/users/1/edit'],
            'profile' => ['get', '/profile'],
        ];
    }

    #[DataProvider('protectedGetRoutes')]
    public function test_guests_are_redirected_to_login(string $method, string $uri): void
    {
        $this->{$method}($uri)->assertRedirect(route('login'));
    }

    public function test_guests_cannot_write_to_protected_resources(): void
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();

        $this->post('/customers', ['full_name' => 'X', 'email' => 'x@example.com'])
            ->assertRedirect(route('login'));
        $this->put("/customers/{$customer->id}", ['full_name' => 'X', 'email' => 'x@example.com'])
            ->assertRedirect(route('login'));
        $this->delete("/customers/{$customer->id}")->assertRedirect(route('login'));

        $this->post('/users', [])->assertRedirect(route('login'));
        $this->put("/users/{$user->id}", [])->assertRedirect(route('login'));
        $this->delete("/users/{$user->id}")->assertRedirect(route('login'));

        $this->assertDatabaseHas('customers', ['id' => $customer->id]);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    public function test_logged_in_user_can_reach_protected_pages(): void
    {
        $me = User::factory()->create();
        $customer = Customer::factory()->create();
        $other = User::factory()->create();

        $this->actingAs($me);

        $this->get('/dashboard')->assertOk();
        $this->get('/customers')->assertOk()->assertSee($customer->full_name);
        $this->get('/customers/create')->assertOk();
        $this->get("/customers/{$customer->id}")->assertOk();
        $this->get("/customers/{$customer->id}/edit")->assertOk();
        $this->get('/users')->assertOk()->assertSee($other->username);
        $this->get('/users/create')->assertOk();
        $this->get("/users/{$other->id}")->assertOk();
        $this->get("/users/{$other->id}/edit")->assertOk();
        $this->get('/profile')->assertOk();
    }

    public function test_visiting_protected_page_then_logging_in_returns_to_that_page(): void
    {
        $user = User::factory()->create();

        $this->get('/customers')->assertRedirect(route('login'));

        $this->post('/login', ['email' => $user->email, 'password' => 'password'])
            ->assertRedirect('/customers');
    }

    public function test_root_redirects_guests_to_login_and_users_to_dashboard(): void
    {
        $this->get('/')->assertRedirect(route('login'));

        $this->actingAs(User::factory()->create())
            ->get('/')->assertRedirect(route('dashboard'));
    }

    public function test_logged_in_users_are_kept_away_from_login_page(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/login')->assertRedirect(route('dashboard'));
    }
}
