<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.edit_category') }}</h1>
        @include('categories.form', ['category' => $category])
    </div>
</x-app-layout>