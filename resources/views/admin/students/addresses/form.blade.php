<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf
    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <!-- Name -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $address->name ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
               required>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Details -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Details</label>
        <textarea name="details"
                  class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('details', $address->details ?? '') }}</textarea>
        @error('details') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Country -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Country</label>
        <input type="text" name="country" value="{{ old('country', $address->country ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
        @error('country') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- City -->
    <div>
        <label class="block text-sm font-medium text-gray-700">City</label>
        <input type="text" name="city" value="{{ old('city', $address->city ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
        @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Governorate -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Governorate</label>
        <input type="text" name="governorate" value="{{ old('governorate', $address->governorate ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
        @error('governorate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Flag -->
    <div class="flex items-center space-x-2">
        <input type="checkbox" name="flag" value="1"
               {{ old('flag', $address->flag ?? false) ? 'checked' : '' }}
               class="h-4 w-4 text-blue-600 border-gray-300 rounded">
        <label class="text-sm text-gray-700">Default Address</label>
    </div>

    <div>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            {{ isset($address) ? 'Update Address' : 'Add Address' }}
        </button>
    </div>
</form>
