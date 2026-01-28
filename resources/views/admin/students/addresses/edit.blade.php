@extends('admin.layouts.app')

@section('title', 'Edit Address for ' . $student->name)

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Edit Address for {{ $student->name }}</h2>
    @include('admin.students.addresses.form', [
        'address' => $address,
        'action' => route('admin.students.addresses.update', [$student, $address]),
        'method' => 'PUT'
    ])
</div>
@endsection
