@extends('admin.layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Edit Student</h2>
    @include('admin.students.form', [
        'student' => $student,
        'action' => route('admin.students.update', $student),
        'method' => 'PUT'
    ])
</div>
@endsection
