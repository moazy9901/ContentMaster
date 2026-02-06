@extends('admin.layouts.app')

@section('title', 'Add Address for ' . $customer->name)

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Add Address for {{ $customer->name }}</h2>
    @include('admin.customers.addresses.form', ['action' => route('admin.customers.addresses.store', $customer)])
</div>
@endsection
