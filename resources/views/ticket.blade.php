@extends('layouts.user')

@section('content')
<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-10 border-b-4 border-indigo-600 pb-3">
        My Booked Tickets
    </h2>

    @forelse ($user->tickets->chunk(2) as $ticketPair)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            @foreach ($ticketPair as $booking)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3 truncate">
                            Booking #{{ $booking->id }}
                        </h3>

                        <div class="space-y-1 text-gray-700 text-sm">
                            <p><span class="font-medium">Train:</span> {{ $booking->train->name ?? '—' }}</p>
                            <p><span class="font-medium">Date:</span> {{ \Carbon\Carbon::parse($booking->train->date)->format('d M Y') ?? '—' }}</p>
                            <p><span class="font-medium">Start Time:</span> {{ $booking->train['start-time'] ?? '—' }}</p>
                            <p><span class="font-medium">End Time:</span> {{ $booking->train['end-time'] ?? '—' }}</p>
                            <p><span class="font-medium">Route:</span> {{ $booking->train->route->name ?? '—' }}</p>
                            <p><span class="font-medium">Total Distance:</span> {{ $booking->train->route->total_distances ?? '—' }} KM</p>
                            <p><span class="font-medium">Price:</span> <span class="text-indigo-600 font-semibold">₹{{ number_format($booking->price, 2) }}</span></p>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h4 class="text-sm font-semibold text-gray-800 mb-2 border-b border-gray-200 pb-1">
                            Classes Booked
                        </h4>
                        <ul class="list-disc list-inside text-gray-600 text-xs space-y-1">
                            @foreach ($booking->bookClasses as $seat)
                                <li>{{ $seat->class_name }}: <strong class="text-indigo-600">{{ $seat->count }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-center text-gray-500 text-lg mt-20">You have not booked any tickets yet.</p>
    @endforelse
</div>
@endsection
