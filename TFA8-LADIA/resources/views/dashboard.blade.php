@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="panel">
    <h1 class="h3">Welcome, {{ auth()->user()->full_name }}</h1>
    <p class="text-muted">You are logged in. Only logged-in users can reach the pages below.</p>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="border rounded p-3 h-100">
                <div class="display-6">{{ $customerCount }}</div>
                <div class="text-muted mb-2">Customer accounts</div>
                <a href="{{ route('customers.index') }}" class="btn btn-sm btn-primary">Manage customers</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="border rounded p-3 h-100">
                <div class="display-6">{{ $userCount }}</div>
                <div class="text-muted mb-2">User accounts</div>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">Manage users</a>
            </div>
        </div>
    </div>
</div>
@endsection
