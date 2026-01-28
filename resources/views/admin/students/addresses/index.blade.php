@extends('admin.layouts.app')

@section('title', 'Addresses for ' . $student->name)

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold text-slate-800">Addresses for {{ $student->name }}</h2>
    <a href="{{ route('admin.students.addresses.create', $student) }}"
       class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
        Add Address
    </a>
</div>

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 text-left font-medium text-gray-600">ID</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Name</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Details</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Country</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">City</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Governorate</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Default</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($addresses as $address)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-3 py-2 truncate">{{ $address->id }}</td>
                <td class="px-3 py-2 truncate">{{ $address->name }}</td>
                <td class="px-3 py-2 truncate">{{ $address->details }}</td>
                <td class="px-3 py-2 truncate">{{ $address->country }}</td>
                <td class="px-3 py-2 truncate">{{ $address->city }}</td>
                <td class="px-3 py-2 truncate">{{ $address->governorate }}</td>
                <td class="px-3 py-2">
    <form action="{{ route('admin.students.addresses.default', [$student, $address]) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit"
                class="px-2 py-1 text-xs rounded transition
                       {{ $address->flag ? 'bg-green-500 text-white hover:bg-green-600' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            {{ $address->flag ? 'Yes' : 'No' }}
        </button>
    </form>
</td>

                <td class="px-3 py-2 space-x-1">
                    <a href="{{ route('admin.students.addresses.edit', [$student, $address]) }}"
                       class="px-2 py-1 text-orange-500 text-xs rounded transition">Edit</a>

                    <form action="{{ route('admin.students.addresses.destroy', [$student, $address]) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this address?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 text-red-500 text-xs rounded transition">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-3 py-2 text-gray-500 text-center">No addresses found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $addresses->links('pagination::simple-tailwind') }}
</div>
@endsection
