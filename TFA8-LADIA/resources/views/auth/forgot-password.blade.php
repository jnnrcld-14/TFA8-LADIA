@extends('layouts.guest')
@section('title', 'Forgot password')
@section('content')
<h1 class="h4 mb-3">Forgot your password?</h1>
<p class="text-muted small">Enter your email address and we will send you a password reset link. (In local development the email is written to <code>storage/logs/laravel.log</code>.)</p>
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
               class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('login') }}" class="small">Back to log in</a>
        <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
    </div>
</form>
@endsection
