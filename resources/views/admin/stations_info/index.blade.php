@extends('layouts.admin')

@section('title', 'Station Information')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Station Information</h2>
        <a href="{{ route('admin.station_info.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 transition duration-200">
            + Add Station
        </a>
    </div>

    <!-- Total Stations -->
    <div class="mb-4">
        <p class="text-base text-gray-700">Total Stations:
            <span class="font-bold text-gray-900">{{ $stationCount }}</span>
        </p>
    </div>

    <!-- Stations Table -->
    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="min-w-full bg-white border border-indigo-100">
            <thead class="bg-indigo-50 text-gray-700 text-sm">
                <tr>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Station Name</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Station Code</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Total Platforms</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">
                @forelse ($station_info as $station)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="py-2 px-4 border-b border-gray-100">{{ $station->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $station->code }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $station->total_no_platforms }}</td>
                        <td class="py-2 px-4 border-b border-gray-100 text-center">
                            <a href="{{route('admin.station_info.edit',$station->id)}}"
                               class="text-indigo-600 hover:text-indigo-800 px-2">Edit</a>
                            <form action="{{route('admin.station_info.destroy',$station->id)}}"
                                  method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 px-2 transition"
                                        onclick="return confirm('Are you sure you want to delete this station?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            No stations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
