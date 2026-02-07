@csrf

<div class="space-y-4">

    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            required>
        @error('name')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
     <!-- Slug -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Slug') }} *</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            <p id="slug-message" class="text-sm mt-1 text-gray-500">{{ __('site.format') }}</p>
            @error('slug') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
    <!-- Image -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        <input type="file" name="image" id="image" accept="image/*"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition">
        @if(isset($category->image) && $category->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-20 rounded">
            </div>
        @endif
        @error('image')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Meta Title -->
    <div>
        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            maxlength="255">
        @error('meta_title')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Meta Description -->
    <div>
        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
        <textarea name="meta_description" id="meta_description" rows="3"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            maxlength="500">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
        @error('meta_description')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Meta Keywords -->
    <div>
        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            maxlength="255">
        @error('meta_keywords')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex gap-2">
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            {{ isset($category) ? 'Update Category' : 'Create Category' }}
        </button>
        <a href="{{ route('admin.categories.index') }}"
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
            Cancel
        </a>
    </div>

</div>

<x-slug-validation-script
    route="{{ route('categories.validateSlug') }}"
/>

