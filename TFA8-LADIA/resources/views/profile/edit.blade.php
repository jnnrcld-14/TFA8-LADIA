@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="mx-auto" style="max-width: 720px">
    <div class="panel mb-4">
        <h1 class="h4">Profile Information</h1>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            @foreach (['username' => 'Username', 'full_name' => 'Full Name', 'email' => 'Email'] as $field => $label)
                <div class="mb-3">
                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                    <input type="{{ $field === 'email' ? 'email' : 'text' }}" id="{{ $field }}" name="{{ $field }}"
                           value="{{ old($field, $user->$field) }}" required
                           class="form-control @error($field) is-invalid @enderror">
                    @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            @endforeach
            <button class="btn btn-primary">Save</button>
        </form>
    </div>

    <div class="panel mb-4">
        <h2 class="h4">Update Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror">
                @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="password" autocomplete="new-password"
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror">
                @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="new_password_confirmation" name="password_confirmation" autocomplete="new-password" class="form-control">
            </div>
            <button class="btn btn-primary">Update Password</button>
        </form>
    </div>

    <div class="panel border border-danger-subtle">
        <h2 class="h4 text-danger">Delete Account</h2>
        <p class="text-muted">Once deleted, this account cannot be recovered. Enter your password to confirm.</p>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password"
                       class="form-control @error('password', 'userDeletion') is-invalid @enderror">
                @error('password', 'userDeletion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-danger" onclick="return confirm('Delete your account permanently?')">Delete Account</button>
        </form>
    </div>
</div>
@endsection
