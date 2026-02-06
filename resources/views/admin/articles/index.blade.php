@extends('admin.layouts.app')

@section('title', 'Articles Management')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold text-slate-800">Articles</h2>
    <a href="{{ route('admin.articles.create') }}"
      class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
      Create Article
    </a>
  </div>

  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="w-full text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 text-left font-medium text-gray-600">ID</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Title</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Category</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Author</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Created</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($articles as $article)
          <tr class="border-b hover:bg-gray-50">
            <td class="px-3 py-2 truncate">{{ $article->id }}</td>
            <td class="px-3 py-2 truncate">{{ $article->title }}</td>
            <td class="px-3 py-2 truncate">{{ $article->category->name ?? '-' }}</td>
            <td class="px-3 py-2 truncate">{{ $article->user->name ?? '-' }}</td>
            <td class="px-3 py-2 truncate">{{ $article->created_at->format('M d, Y') }}</td>
            <td class="px-3 py-2 space-x-1">
              <a href="{{ route('admin.articles.edit', $article) }}"
                class="px-2 py-1 text-orange-500 text-xs rounded transition">
                Edit
              </a>
              <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block"
                onsubmit="return confirm('Are you sure you want to delete this article?');">
                @csrf
                @method('DELETE')
                <button class="px-2 py-1 text-red-500 text-xs rounded transition">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-3 py-2 text-gray-500 text-center">No articles found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $articles->links('pagination::simple-tailwind') }}
  </div>
@endsection
