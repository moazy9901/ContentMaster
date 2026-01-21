@props(['category' => null, 'categories'])

<div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-10 mt-10">

    <h2 class="text-3xl font-bold text-gray-800 mb-8">
        {{ $category ?  __('site.edit_category') :  __('site.new catogory') }} 
    </h2>

    <form action="{{ $category ? route('categories.update', $category) : route('categories.store') }}" method="POST"
        enctype="multipart/form-data" class="space-y-7">

        @csrf
        @if($category)
            @method('PUT')
        @endif

     

        <!-- name -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Name') }} *</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
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
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Image') }}</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-5
                          file:rounded-xl file:border-0 file:text-sm file:font-semibold
                          file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 transition">
            @if($category && $category->image)
                <img src="{{ asset('storage/' . $category->image) }}" class="mt-4 w-56 h-36 object-cover rounded-xl shadow">
            @endif
            @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Meta Title -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Meta Title') }}</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            @error('meta_title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Meta Description -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Meta Description') }}</label>
            <textarea name="meta_description" rows="4"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
            @error('meta_description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Keywords -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('site.Meta Keywords') }}</label>
            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            @error('meta_keywords') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div class="pt-6">
            <button type="submit"
                class="w-full px-6 py-4 rounded-2xl bg-indigo-600 text-white font-bold text-lg hover:bg-indigo-700 transition">
                {{ $category ? 'Update category' : 'Create category' }}
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
            const response = await fetch("{{ route('categories.validateSlug') }}", {
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