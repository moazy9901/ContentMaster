@extends('admin.layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Edit Customer</h2>
    @include('admin.customers.form', [
        'customer' => $customer,
        'action' => route('admin.customers.update', $customer),
        'method' => 'PUT'
    ])
</div>
@endsection
