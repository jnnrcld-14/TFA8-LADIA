@extends('layouts.app')
@section('title', 'User Details')
@section('content')
<div class="panel mx-auto" style="max-width: 720px">
    <h1 class="h3">User Details</h1>
    <div class="d-flex align-items-center gap-3 my-3">
        <img class="avatar-preview" src="{{ $user->avatar_url }}" alt="Avatar for {{ $user->full_name }}">
        <div>
            <div class="h5 mb-0">{{ $user->full_name }}</div>
            <div class="text-muted">{{ '@' . $user->username }}</div>
        </div>
    </div>
    <dl class="row">
        <dt class="col-sm-4">Email</dt><dd class="col-sm-8">{{ $user->email }}</dd>
        <dt class="col-sm-4">Created</dt><dd class="col-sm-8">{{ $user->created_at?->format('M d, Y h:i A') }}</dd>
        <dt class="col-sm-4">Last Updated</dt><dd class="col-sm-8">{{ $user->updated_at?->format('M d, Y h:i A') }}</dd>
    </dl>
    <div class="d-flex gap-2">
        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>
@endsection
