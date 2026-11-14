<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_resource_registers_all_seven_routes(): void
    {
        foreach (['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'] as $action) {
            $this->assertTrue(app('router')->has("customers.$action"), "customers.$action is missing");
        }
    }

    public function test_store_creates_customer(): void
    {
        $this->post(route('customers.store'), ['full_name' => 'Ana Cruz', 'email' => 'ana@example.com'])
            ->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', ['email' => 'ana@example.com']);
    }

    public function test_store_validates_unique_email(): void
    {
        Customer::factory()->create(['email' => 'dup@example.com']);

        $this->post(route('customers.store'), ['full_name' => 'Dup', 'email' => 'dup@example.com'])
            ->assertSessionHasErrors('email');
    }

    public function test_update_changes_customer(): void
    {
        $customer = Customer::factory()->create();

        $this->put(route('customers.update', $customer), ['full_name' => 'New Name', 'email' => $customer->email])
            ->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', ['id' => $customer->id, 'full_name' => 'New Name']);
    }

    public function test_destroy_deletes_customer(): void
    {
        $customer = Customer::factory()->create();

        $this->delete(route('customers.destroy', $customer))->assertRedirect(route('customers.index'));

        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
