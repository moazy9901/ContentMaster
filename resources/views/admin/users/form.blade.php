@csrf

<div class="space-y-4">

    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition">
        @error('name')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition">
        @error('email')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Role -->
    <div>
        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
        <select name="role" id="role"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition">
            @foreach(['admin', 'editor', 'customer'] as $role)
                <option value="{{ $role }}" @selected(old('role', $user->role ?? '') == $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        @error('role')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
@if(!isset($user))
    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition"
            placeholder="{{ isset($user) ? 'Leave blank to keep current password' : '' }}">
        @error('password')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none transition">
    </div>
@endif
    <!-- Submit Button -->
    <div>
        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition">
            {{ $buttonText }}
        </button>
    </div>

</div>