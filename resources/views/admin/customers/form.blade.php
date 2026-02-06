<form action="{{ $action }}" method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf
    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <!-- Name -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
               required>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
               required>
        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <!-- Password -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" value="{{ old('password', $customer->password ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
               required>
        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Phone -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}"
               class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Gender -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Gender</label>
        <select name="gender" class="mt-1 block w-full border rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender', $customer->gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $customer->gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Profile Image</label>
        <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500">
        @if(isset($customer->image))
            <img src="{{ asset('storage/' . $customer->image) }}" alt="Profile Image" class="w-24 mt-2 rounded">
        @endif
        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            {{ isset($customer) ? 'Update Customer' : 'Create Customer' }}
        </button>
    </div>
</form>
