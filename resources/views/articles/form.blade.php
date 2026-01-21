@props(['article' => null, 'categories'])

<div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-10 mt-10">

    <h2 class="text-3xl font-bold text-gray-800 mb-8">
        {{ $article ? __('site.edit_article') : __('site.new articles') }}
    </h2>

    <form action="{{ $article ? route('articles.update', $article) : route('articles.store') }}" method="POST"
        enctype="multipart/form-data" class="space-y-7">

        @csrf
        @if($article)
            @method('PUT')
        @endif

        <!-- Category -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.categories') }} *</label>
            <select name="category_id"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Title') }} *</label>
            <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
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
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Image') }}</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-5
                          file:rounded-xl file:border-0 file:text-sm file:font-semibold
                          file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 transition">
            @if($article && $article->image)
                <img src="{{ asset('storage/' . $article->image) }}" class="mt-4 w-56 h-36 object-cover rounded-xl shadow">
            @endif
            @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.content') }} *</label>
            <textarea name="content" rows="8"
                class="w-full px-4 py-4 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('content', $article->content ?? '') }}</textarea>
            @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Meta Description -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Meta Description') }}</label>
            <textarea name="meta_description" rows="4"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('meta_description', $article->description ?? '') }}</textarea>
            @error('meta_description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Keywords -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Meta Keywords') }}</label>
            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $article->keywords ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            @error('meta_keywords') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div class="pt-6">
            <button type="submit"
                class="w-full px-6 py-4 rounded-2xl bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-700 transition">
                {{ $article ?  __('site.edit_article') : __('site.create_article') }}
            </button>
        </div>

    </form>
</div>

<script>
    const slugInput = document.getElementById('slug');
    const slugMessage = document.getElementById('slug-message');

    slugInput?.addEventListener('input', async () => {
        const slug = slugInput.value;

        if (!slug) {
            slugMessage.textContent = '';
            return;
        }

        try {
            const response = await fetch("{{ route('articles.validateSlug') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ slug })
            });

            const data = await response.json();
            slugMessage.textContent = data.message;
            slugMessage.className = data.valid ? 'text-green-600 text-sm mt-1' : 'text-red-600 text-sm mt-1';
        } catch (err) {
            console.error(err);
            slugMessage.textContent = 'Error validating slug.';
            slugMessage.className = 'text-red-600 text-sm mt-1';
        }
    });
</script>