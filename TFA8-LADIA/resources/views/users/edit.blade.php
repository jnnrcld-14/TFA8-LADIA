@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="panel mx-auto" style="max-width: 720px">
    <h1 class="h3">Edit User Account</h1>
    <p class="text-muted">Update the account details and optionally upload a new profile picture.</p>
    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('users._form', ['submitLabel' => 'Update User'])
    </form>
</div>
@endsection
