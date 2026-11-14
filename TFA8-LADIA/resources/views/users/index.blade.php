@extends('layouts.app')
@section('title', 'User Accounts')
@section('content')
<div class="panel">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1">User Accounts</h1>
            <p class="text-muted mb-0">Manage POS users and their profile pictures.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light"><tr><th>#</th><th>Avatar</th><th>Username</th><th>Full Name</th><th>Email</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td><img class="avatar" src="{{ $user->avatar_url }}" alt="Avatar for {{ $user->full_name }}"></td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            @if (! auth()->user()->is($user))
                                <form method="POST" action="{{ route('users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No user accounts found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
@endsection
