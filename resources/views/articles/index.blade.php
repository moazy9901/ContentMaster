<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ __('site.articles') }}</h1>
            @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}"
               class="inline-flex items-center px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition">
                + {{ __('site.new articles') }}
            </a>
            @endcan
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($articles as $article)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">

                    <!-- Image -->
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('article.webp') }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-6">

                        <!-- Category -->
                        <span class="inline-block mb-3 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                            {{ $article->category->name }}
                        </span>

                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            {{ $article->title }}
                        </h2>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $article->description }}
                        </p>

                        <!-- Actions -->
                        <div class="flex items-center justify-between mt-4">

                            <a href="{{ route('articles.show', $article) }}"
                               class="text-indigo-600 font-medium hover:underline">
                                {{ __('site.Read More') }}
                            </a>

                            <div class="flex space-x-2">
                                @can('update', $article)
                                <a href="{{ route('articles.edit', $article) }}"
                                   class="px-3 py-1.5 rounded-lg text-sm bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                    {{ __('site.Edit') }}
                                </a>
                                @endcan
                                @can('delete', $article)
                                <form action="{{ route('articles.destroy', $article) }}" method="POST"
                                      onsubmit="return confirm('Delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1.5 rounded-lg text-sm bg-red-100 text-red-600 hover:bg-red-200">
                                        {{ __('site.Delete') }}
                                    </button>
                                </form>
                                @endcan
                            </div>

                        </div>

                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500 text-lg">{{ __('site.no articals') }}</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $articles->links() }}
        </div>

    </div>

</x-app-layout>
