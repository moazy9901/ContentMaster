<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ __('site.categories') }}</h1>

            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition">
                + {{ __('site.new catogory') }}
            </a>
        </div>

        <!-- categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($categories as $catogory)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">

                    <!-- Image -->
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $catogory->image ? asset('storage/' . $catogory->image) : asset('istockphoto.jpg') }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-6">

                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            {{ $catogory->name }}
                        </h2>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $catogory->meta_description }}
                        </p>

                        <!-- Actions -->
                        <div class="flex items-center justify-between mt-4">

                            <a href="{{ route('categories.show', $catogory) }}"
                                class="text-indigo-600 font-medium hover:underline">
                                {{ __('site.Read More') }} 
                            </a>

                            <div class="flex space-x-2">
                                <a href="{{ route('categories.edit', $catogory) }}"
                                    class="px-3 py-1.5 rounded-lg text-sm bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                    {{ __('site.Edit') }}
                                </a>

                                <form action="{{ route('categories.destroy', $catogory) }}" method="POST"
                                    onsubmit="return confirm('Delete this catogory?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1.5 rounded-lg text-sm bg-red-100 text-red-600 hover:bg-red-200">
                                        {{ __('site.Delete') }}
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500 text-lg">{{ __('site.no categories') }}</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $categories->links() }}
        </div>

    </div>

</x-app-layout>