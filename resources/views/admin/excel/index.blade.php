@extends('admin.layouts.app')

@section('title', 'Excel Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">Excel Import & Export Dashboard</h1>

        <!-- Import / Export Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white shadow rounded-lg p-4 md:p-6 mb-6 gap-4">

    <!-- Import Form -->
    <form method="POST" action="{{ route('admin.excel.import') }}" enctype="multipart/form-data"
        class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
        @csrf
        <input type="file" name="file" required
            class="border border-gray-300 rounded px-3 py-2 text-sm w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition">
            Import Excel
        </button>
    </form>

    <!-- Export Buttons -->
    <div class="flex flex-wrap gap-2 justify-start">
        <a href="{{ route('admin.excel.export') }}"
            class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded transition">
            Export Excel
        </a>
        <a href="{{ route('admin.excel.exportPdfMpdf') }}"
            class="bg-gray-800 hover:bg-gray-900 text-white text-sm px-4 py-2 rounded transition">
            Export PDF
        </a>
    </div>
</div>


        <!-- Type Switcher -->
        @php
            $types = ['client' => 'Clients', 'owner' => 'Owners', 'admin' => 'Admins'];
            $currentType = request()->get('type', 'client');
            $paginated = ${$currentType};
        @endphp

        <div class="flex gap-2 mb-4">
            @foreach($types as $key => $label)
                <a href="{{ route('admin.excel.index', ['type' => $key]) }}"
                    class="px-3 py-1 rounded-md font-medium text-sm transition
                        {{ $currentType === $key ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Records Table -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="text-left px-4 py-2 border-b">#</th>
                        <th class="text-left px-4 py-2 border-b">Name</th>
                        <th class="text-left px-4 py-2 border-b">Email</th>
                        <th class="text-left px-4 py-2 border-b">Phone</th>
                        <th class="text-left px-4 py-2 border-b">Age</th>
                        <th class="text-left px-4 py-2 border-b">Address</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($paginated as $index => $record)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : '' }}">
                            <td class="px-4 py-2 border-b">{{ $paginated->firstItem() + $index }}</td>
                            <td class="px-4 py-2 border-b">{{ $record->name ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $record->email ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $record->phone ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $record->age ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $record->address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $paginated->withQueryString()->links('pagination::simple-tailwind') }}
        </div>
    </div>
@endsection