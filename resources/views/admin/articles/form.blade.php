@csrf

<div class="space-y-4">

    <!-- Category -->
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <select name="category_id" id="category_id"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            required>
        @error('title')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <!-- Slug -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Slug') }} *</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            <p id="slug-message" class="text-sm mt-1 text-gray-500">{{ __('site.format') }}</p>
            @error('slug') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
    <!-- Image -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        <input type="file" name="image" id="image" accept="image/*"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition">
        @if(isset($article->image) && $article->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="h-20 rounded">
            </div>
        @endif
        @error('image')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Content -->
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
        <textarea name="content" id="content" rows="10"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            required>{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="3"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            maxlength="500">{{ old('description', $article->description ?? '') }}</textarea>
        <small class="text-gray-500">Max 500 characters</small>
        @error('description')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Keywords -->
    <div>
        <label for="keywords" class="block text-sm font-medium text-gray-700 mb-1">Keywords</label>
        <input type="text" name="keywords" id="keywords" value="{{ old('keywords', $article->keywords ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            maxlength="255"
            placeholder="Comma separated keywords">
        @error('keywords')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex gap-2">
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            {{ isset($article) ? 'Update Article' : 'Create Article' }}
        </button>
        <a href="{{ route('admin.articles.index') }}"
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
            Cancel
        </a>
    </div>

</div>

<x-slug-validation-script
    route="{{ route('articles.validateSlug') }}"
/>
