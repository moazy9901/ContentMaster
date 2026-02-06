@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Create Category</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.categories.form')
    </form>
</div>
@endsection
