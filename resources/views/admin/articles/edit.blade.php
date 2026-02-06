@extends('admin.layouts.app')

@section('title', 'Edit Article')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Edit Article</h2>
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.articles.form')
    </form>
</div>
@endsection
