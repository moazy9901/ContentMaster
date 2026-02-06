@extends('admin.layouts.app')

@section('title', 'Customers Management')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold text-slate-800">Customers</h2>
    <a href="{{ route('admin.customers.create') }}"
       class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
        Create Customer
    </a>
</div>

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 text-left font-medium text-gray-600">ID</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Name</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Email</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Phone</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Gender</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Addresses</th>
                <th class="px-3 py-2 text-left font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-3 py-2 truncate">{{ $customer->id }}</td>
                <td class="px-3 py-2 truncate">{{ $customer->name }}</td>
                <td class="px-3 py-2 truncate">{{ $customer->email }}</td>
                <td class="px-3 py-2 truncate">{{ $customer->phone ?? '-' }}</td>
                <td class="px-3 py-2 capitalize">{{ $customer->gender ?? '-' }}</td>
                <td class="px-3 py-2">
                <a href="{{ route('admin.customers.addresses.index', $customer) }}"
                class="flex flex-col items-center justify-center px-3 py-2 text-blue-500 text-xs rounded border border-blue-500 hover:bg-blue-50 transition">
                    <span class="text-md font-semibold leading-none">
                        {{ $customer->addresses->count() }}
                    </span>

                    <span class="text-[10px] uppercase tracking-wide">
                        Address{{ $customer->addresses->count() !== 1 ? 'es' : '' }}
                    </span>
                </a>

</td>

                <td class="px-3 py-2 space-x-1">
                    <a href="{{ route('admin.customers.edit', $customer) }}"
                       class="px-2 py-1 text-orange-500 text-xs rounded transition">
                        Edit
                    </a>

                    <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Are you sure you want to delete this customer?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-2 py-1 text-red-500 text-xs rounded transition">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-3 py-2 text-gray-500 text-center">No Customers found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $customers->links('pagination::simple-tailwind') }}
</div>

@endsection
