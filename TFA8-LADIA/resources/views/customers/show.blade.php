@extends('layouts.app')
@section('title', 'Customer Details')
@section('content')
<div class="panel mx-auto" style="max-width: 720px">
    <h1 class="h3">Customer Details</h1>
    <dl class="row mt-3">
        <dt class="col-sm-4">Full Name</dt><dd class="col-sm-8">{{ $customer->full_name }}</dd>
        <dt class="col-sm-4">Email</dt><dd class="col-sm-8">{{ $customer->email }}</dd>
        <dt class="col-sm-4">Created</dt><dd class="col-sm-8">{{ $customer->created_at?->format('M d, Y h:i A') }}</dd>
        <dt class="col-sm-4">Last Updated</dt><dd class="col-sm-8">{{ $customer->updated_at?->format('M d, Y h:i A') }}</dd>
    </dl>
    <div class="d-flex gap-2">
        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>
</div>
@endsection
