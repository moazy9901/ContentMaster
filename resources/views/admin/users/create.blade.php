@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-sm">
        <h1 class="text-lg font-semibold text-slate-800 mb-4">Create User</h1>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-3">
            @csrf
            @include('admin.users.form', ['buttonText' => 'Create User'])
        </form>
    </div>
@endsection