<x-app-layout>

    <div class="max-w-5xl mx-auto px-4 py-10">

        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-500">
            <a href="{{ route('articles.index') }}" class="hover:text-indigo-600">{{ __('site.articles') }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 font-medium">{{ $article->slug }}</span>
        </div>

        <!-- Hero Image -->
        <div class="rounded-3xl overflow-hidden shadow-lg mb-10">
            <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('article.webp') }}"
                class="w-full h-[420px] object-cover">
        </div>

        <!-- Article Header -->
        <div class="mb-10">

            <!-- Category -->
            <span class="inline-block mb-4 px-4 py-1.5 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-700">
                {{ $article->category->name }}
            </span>

            <!-- Title -->
            <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                {{ $article->title }}
            </h1>

            <!-- Meta -->
            <div class="flex items-center text-gray-500 text-sm space-x-4">
                <span>{{ $article->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span>{{ $article->category->name }}</span>
            </div>

        </div>

        <!-- Article Content -->
        <article class="prose prose-lg max-w-none mb-16">
            {!! nl2br(e($article->content)) !!}
        </article>

        <!-- SEO Info -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-10">

            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('site.SEO') }}</h3>

            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">{{ __('site.Meta Title') }}</p>
                    <p class="text-gray-800">{{ $article->meta_title ?? $article->title }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">{{ __('site.Meta Description') }}</p>
                    <p class="text-gray-800">{{ $article->description }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">{{ __('site.Meta Keywords') }}</p>
                    <p class="text-gray-800">{{ $article->keywords }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">

            <a href="{{ route('articles.index') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                 {{ __('site.Back_to') }} {{ __('site.articles') }}
            </a>

            <div class="flex space-x-3">
                @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}"
                    class="px-5 py-2.5 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600 transition">
                    {{ __('site.Edit') }}
                </a>
                @endcan
                @can('delete', $article)
                <form action="{{ route('articles.destroy', $article) }}" method="POST"
                    onsubmit="return confirm('Delete this article?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                        {{ __('site.Delete') }}
                    </button>
                </form>
                @endcan
            </div>

        </div>

    </div>

</x-app-layout>