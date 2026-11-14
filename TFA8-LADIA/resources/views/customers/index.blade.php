@extends('layouts.app')
@section('title', 'Customers')
@section('content')
<div class="panel">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1">Customer Accounts</h1>
            <p class="text-muted mb-0">Create and maintain POS customer records.</p>
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Create Customer</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light"><tr><th>#</th><th>Full Name</th><th>Email</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customers->firstItem() + $loop->index }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('customers.destroy', $customer) }}"
                                  onsubmit="return confirm('Delete this customer?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No customer accounts found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $customers->links() }}
</div>
@endsection
