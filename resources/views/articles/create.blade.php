<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('site.new articles') }}</h1>
        @include('articles.form', ['categories' => $categories])
</x-app-layout>