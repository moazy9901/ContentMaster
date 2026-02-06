@extends('admin.layouts.app')

@section('title', 'Create Customer')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Create Customer</h2>
    @include('admin.customers.form', ['action' => route('admin.customers.store')])
</div>
@endsection
