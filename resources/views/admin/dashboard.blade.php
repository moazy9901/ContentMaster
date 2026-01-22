@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
            <!-- Users Card -->
            <div
                class="bg-white rounded-xl shadow-md border-l-4 border-indigo-500 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 uppercase tracking-wide">Total Users</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $usersCount }}</p>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20H4v-2a4 4 0 014-4h1" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                </div>
            </div>
        @endif

        <!-- Articles Card -->
        <div
            class="bg-white rounded-xl shadow-md border-l-4 border-green-500 p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Articles</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $articlesCount }}</p>
                </div>
                <div
                    class="bg-green-100 text-green-600 p-3 rounded-full flex items-center justify-center shadow-sm text-lg">
                    📝
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div
            class="bg-white rounded-xl shadow-md border-l-4 border-yellow-500 p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Categories</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $categoriesCount }}</p>
                </div>
                <div
                    class="bg-yellow-100 text-yellow-600 p-3 rounded-full flex items-center justify-center shadow-sm text-lg">
                    📂
                </div>
            </div>
        </div>

    </div>
@endsection