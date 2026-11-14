@extends('layouts.guest')
@section('title', 'Register')
@section('content')
<h1 class="h4 mb-3">Create an account</h1>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus maxlength="100"
               class="form-control @error('username') is-invalid @enderror">
        @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required maxlength="255" autocomplete="name"
               class="form-control @error('full_name') is-invalid @enderror">
        @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
               class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" required autocomplete="new-password"
               class="form-control @error('password') is-invalid @enderror">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
               class="form-control">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('login') }}" class="small">Already registered?</a>
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>
@endsection
