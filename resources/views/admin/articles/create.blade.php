@extends('admin.layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Create Article</h2>
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.articles.form')
    </form>
</div>
@endsection
