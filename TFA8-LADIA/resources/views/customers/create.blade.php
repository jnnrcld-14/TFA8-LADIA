@extends('layouts.app')
@section('title', 'Create Customer')
@section('content')
<div class="panel mx-auto" style="max-width: 720px">
    <h1 class="h3">Create Customer</h1>
    <p class="text-muted">Enter the customer's required information.</p>
    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        @include('customers._form', ['submitLabel' => 'Save Customer'])
    </form>
</div>
@endsection
