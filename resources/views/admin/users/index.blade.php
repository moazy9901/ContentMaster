@extends('admin.layouts.app')

@section('title', 'Users Management')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold text-slate-800">Users</h2>
    <a href="{{ route('admin.users.create') }}"
      class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
      Create User
    </a>
  </div>

  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="w-full text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 text-left font-medium text-gray-600">ID</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Name</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Email</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Role</th>
          <th class="px-3 py-2 text-left font-medium text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr class="border-b hover:bg-gray-50">
            <td class="px-3 py-2 truncate">{{ $user->id }}</td>
            <td class="px-3 py-2 truncate">{{ $user->name }}</td>
            <td class="px-3 py-2 truncate">{{ $user->email }}</td>
            <td class="px-3 py-2 capitalize">{{ $user->role }}</td>
            <td class="px-3 py-2 space-x-1">
              <a href="{{ route('admin.users.edit', $user) }}"
                class="px-2 py-1  text-orange-500 text-xs rounded  transition">
                Edit
              </a>
              <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block"
                onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button class="px-2 py-1  text-red-500 text-xs rounded transition">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-3 py-2 text-gray-500 text-center">No users found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $users->links('pagination::simple-tailwind') }}
  </div>
@endsection