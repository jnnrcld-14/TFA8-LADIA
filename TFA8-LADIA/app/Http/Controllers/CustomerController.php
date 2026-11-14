<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Resource controller for customer accounts.
 *
 * Registered with Route::resource('customers', CustomerController::class)
 * inside the `auth` middleware group in routes/web.php.
 */
class CustomerController extends Controller
{
    /** GET /customers */
    public function index(): View
    {
        $customers = Customer::query()->orderBy('full_name')->paginate(10);

        return view('customers.index', compact('customers'));
    }

    /** GET /customers/create */
    public function create(): View
    {
        return view('customers.create');
    }

    /** POST /customers */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer account created successfully.');
    }

    /** GET /customers/{customer} */
    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }

    /** GET /customers/{customer}/edit */
    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    /** PUT/PATCH /customers/{customer} */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('customers', 'email')->ignore($customer->id),
            ],
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer account updated successfully.');
    }

    /** DELETE /customers/{customer} */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer account deleted successfully.');
    }
}
