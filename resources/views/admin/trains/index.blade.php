@extends('layouts.admin')

@section('title', 'Train Information')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Train Information</h2>
        <a href="{{ route('admin.train_info.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 transition duration-200">
           + Add Train
        </a>
    </div>

    <div class="mb-4">
        <p class="text-base text-gray-700">Total Trains:
            <span class="font-bold text-gray-900">{{ $trainInfo->count() }}</span>
        </p>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="min-w-full bg-white border border-indigo-100">
            <thead class="bg-indigo-50 text-gray-700 text-sm">
                <tr>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Name</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Code</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Route Name</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Total Distances(Km)</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Date</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">Start Time</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-left">End Time</th>
                    <th class="py-3 px-4 border-b border-indigo-100 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">
                @forelse ($trainInfo as $train)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->code }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->route->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->route->total_distances }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->date }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->{'start-time'} }}</td>
                        <td class="py-2 px-4 border-b border-gray-100">{{ $train->{'end-time'} }}</td>
                        <td class="py-2 px-4 border-b border-gray-100 text-center space-x-2">
                            <a href="{{route('admin.train_info.edit',$train->id)}}"
                               class="text-indigo-600 hover:text-indigo-800 px-2">Edit</a>
                            <form action="{{route('admin.train_info.destroy',$train->id)}}"
                                  method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 px-2 transition"
                                        onclick="return confirm('Are you sure you want to delete this train?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">
                            No trains found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @foreach($trainInfo as $train)
        <div class="mt-8 p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                Schedule & Classes for {{ $train->name }} ({{ $train->code }})
            </h3>

            {{-- Classes --}}
            <div class="mb-6">
                <h4 class="font-semibold mb-2">Classes</h4>
                @if($train->trains_class->isEmpty())
                    <p class="text-gray-500">No classes available.</p>
                @else
                    <ul class="list-disc list-inside text-gray-800">
                        @foreach($train->trains_class as $class)
                            <li>
                                <strong>{{ $class->name }}</strong>: Total – <span class="font-medium">{{ $class->total_count }}</span>,
                                Available – <span class="font-medium">{{ $class->available_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Schedule --}}
            <div>
                <h4 class="font-semibold mb-2">Schedule per Station</h4>
                @if($train->Train_Schedule_per_stations->isEmpty())
                    <p class="text-gray-500">No schedule available.</p>
                @else
                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-50 text-gray-700 text-sm">
                                <tr>
                                    <th class="py-2 px-3 border border-gray-200 text-left">Station</th>
                                    <th class="py-2 px-3 border border-gray-200 text-left">Arrival Time</th>
                                    <th class="py-2 px-3 border border-gray-200 text-left">Departure Time</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 text-sm">
                                @foreach($train->Train_Schedule_per_stations as $schedule)
                                    <tr>
                                        <td class="py-2 px-3 border border-gray-200">{{ $schedule->station->name ?? 'N/A' }}</td>
                                        <td class="py-2 px-3 border border-gray-200">{{ $schedule->arrival_time ?? 'N/A' }}</td>
                                        <td class="py-2 px-3 border border-gray-200">{{ $schedule->departure_time ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
