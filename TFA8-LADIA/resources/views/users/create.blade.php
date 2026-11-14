@extends('layouts.app')
@section('title', 'Create User')
@section('content')
<div class="panel mx-auto" style="max-width: 720px">
    <h1 class="h3">Create User Account</h1>
    <p class="text-muted">Enter the username, full name, email and password. A profile picture can be added when editing the account.</p>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        @include('users._form', ['submitLabel' => 'Save User'])
    </form>
</div>
@endsection
