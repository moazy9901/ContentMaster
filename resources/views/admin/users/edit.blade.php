@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
  <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-sm">
    <h1 class="text-lg font-semibold text-slate-800 mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-3">
      @csrf
      @method('PUT')

      @include('admin.users.form', ['buttonText' => 'Update User'])
    </form>
  </div>
@endsection