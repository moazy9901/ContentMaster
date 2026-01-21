<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-10">

        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-500">
            <a href="{{ route('categories.index') }}" class="hover:text-indigo-600">{{ __('site.categories') }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 font-medium">{{ $category->slug }}</span>
        </div>

        <!-- Hero Image -->
        <div class="rounded-3xl overflow-hidden shadow-lg mb-10">
            <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('istockphoto.jpg') }}"
                class="w-full h-[420px] object-cover">
        </div>

        <!-- category Header -->
        <div class="mb-10">

            <!-- Category -->
            <span
                class="inline-block mb-4 px-4 py-1.5 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-700">
                {{ $category->name }}
            </span>

            <!-- Title -->
            <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                {{ $category->meta_title }}
            </h1>

            <!-- Meta -->
            <div class="flex items-center text-gray-500 text-sm space-x-4">
                <span>{{ $category->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span>{{ $category->name }}</span>
            </div>

        </div>

        <!-- SEO Info -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-10">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('site.SEO') }}</h3>

            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">{{ __('site.Meta Title') }}</p>
                    <p class="text-gray-800">{{ $category->meta_title ?? $category->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">{{ __('site.Meta Description') }}</p>
                    <p class="text-gray-800">{{ $category->meta_description }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">{{ __('site.Meta Keywords') }}</p>
                    <p class="text-gray-800">{{ $category->meta_keywords }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">

            <a href="{{ route('categories.index') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                 {{ __('site.Back_to') }} {{ __('site.categories') }}
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('categories.edit', $category) }}"
                    class="px-5 py-2.5 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600 transition">
                    {{ __('site.Edit') }}
                </a>

                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                    onsubmit="return confirm('Delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                        {{ __('site.Delete') }}
                    </button>
                </form>
            </div>

        </div>
    <!-- Related Articles -->
    <div class="my-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">
            {{ __('site.articles') }} : "{{ $category->name }}"
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($category->articles as $article)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                    <div class="h-48 overflow-hidden">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('article.webp') }}"
                            class="w-full h-full object-cover hover:scale-105 transition">
                    </div>

                    <div class="p-6">

                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            {{ $article->title }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $article->content }}
                        </p>

                        <a href="{{ route('articles.show', $article) }}" class="text-indigo-600 font-medium hover:underline">
                            {{ __('site.Read More') }}
                        </a>

                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500 text-lg">No articles found in this category.</p>
                </div>
            @endforelse

        </div>
    </div>
    </div>

</x-app-layout>