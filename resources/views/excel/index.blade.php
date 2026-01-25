@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">


        <h1 class="text-2xl font-bold mb-6 text-gray-800">Excel Import & export Dashboard</h1>
        
        <div class="flex bg-white shadow rounded-lg p-6 mb-8 align-center justify-between">

            <div class="">
                <form method="POST" action="{{ route('excel.import') }}" enctype="multipart/form-data"
                class="flex flex-col md:flex-row items-center gap-x-4">
                @csrf
                <input type="file" name="file" required
                    class="border rounded px-4 py-2 w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition">
                    Import Excel
                </button>
            </form>
        </div>
        <div class="flex align-center justify-center gap-2">
            <a href="{{ route('excel.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">
                Export Excel
            </a>
            <a href="{{ route('excel.exportPdfMpdf') }}" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded transition">
                Export PDF
            </a>

        </div>
            </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="text-left px-4 py-2 border-b">#</th>
                        <th class="text-left px-4 py-2 border-b">Name</th>
                        <th class="text-left px-4 py-2 border-b">Email</th>
                        <th class="text-left px-4 py-2 border-b">Phone</th>
                        <th class="text-left px-4 py-2 border-b"> Age</th>
                        <th class="text-left px-4 py-2 border-b">Address</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($records as $index => $record)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : '' }}">
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $record->name ?? '-'}}</td>
                            <td class="px-4 py-2 border-b">{{ $record->email ?? '-'}}</td>
                            <td class="px-4 py-2 border-b">{{ $record->phone ?? '-'}}</td>
                            <td class="px-4 py-2 border-b">
                                {{ $record->age ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border-b">
                                {{ $record->address ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection