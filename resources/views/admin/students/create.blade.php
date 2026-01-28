@extends('admin.layouts.app')

@section('title', 'Create Student')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Create Student</h2>
    @include('admin.students.form', ['action' => route('admin.students.store')])
</div>
@endsection
