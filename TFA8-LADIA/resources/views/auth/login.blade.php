@extends('layouts.guest')
@section('title', 'Log in')
@section('content')
<h1 class="h4 mb-3">Log in</h1>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
               class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" required autocomplete="current-password"
               class="form-control @error('password') is-invalid @enderror">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('password.request') }}" class="small">Forgot your password?</a>
        <button type="submit" class="btn btn-primary">Log in</button>
    </div>
</form>
<hr>
<p class="small text-center mb-0">No account yet? <a href="{{ route('register') }}">Register</a></p>
@endsection
