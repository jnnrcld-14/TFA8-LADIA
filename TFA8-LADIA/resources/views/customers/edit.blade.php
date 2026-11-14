@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')
<div class="panel mx-auto" style="max-width: 720px">
    <h1 class="h3">Edit Customer</h1>
    <p class="text-muted">Update the selected customer's information.</p>
    <form method="POST" action="{{ route('customers.update', $customer) }}">
        @csrf
        @method('PUT')
        @include('customers._form', ['submitLabel' => 'Update Customer'])
    </form>
</div>
@endsection
