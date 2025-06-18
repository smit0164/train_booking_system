@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
  <div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-4xl font-bold mb-6">Welcome, {{ Auth::guard('user')->user()->name ?? 'smit' }}!</h1>
    <p class="text-gray-600 mb-10">This is your dashboard where you can manage your account and bookings.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($train as $t)
        <div class="border rounded-xl p-6 shadow hover:shadow-lg transition-shadow bg-gray-50">
          <h2 class="text-2xl font-semibold text-blue-700 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5 4a2 2 0 012-2h6a2 ... " clip-rule="evenodd" />
            </svg>
            {{ $t->name ?? 'Train Name' }}
            <span class="ml-auto text-sm font-medium text-gray-500">({{ $t->code ?? 'Code' }})</span>
          </h2>

         <p class="text-gray-700 mb-3">
            <strong class="block text-sm text-gray-500 mb-1">Route</strong>
            @if($t->route)
                <div class="flex items-center space-x-2">
                <span class="text-lg font-semibold text-gray-800">
                    {{ $t->route->name ?? 'Start' }}
                </span>
                <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                    {{ $t->route->total_distances ?? '0KM' }}
                </span>
                </div>
            @else
                <span class="text-gray-500 italic">N/A</span>
            @endif
        </p>
         @foreach ($t->route->stations as $t)
            <p>{{$t->name}}</p>
         @endforeach
          <p class="text-gray-700 mb-3"><strong>Classes:</strong>
            @if($t->trains_class && $t->trains_class->count())
              {{ $t->trains_class->pluck('class_name')->join(', ') }}
            @else
              N/A
            @endif
          </p>

          <p class="text-gray-700 mb-6"><strong>Stations:</strong>
            @if($t->Train_Schedule_per_stations && $t->Train_Schedule_per_stations->count())
              {{ $t->Train_Schedule_per_stations->pluck('station.name')->join(', ') }}
            @else
              N/A
            @endif
          </p>

          <!-- Ticket Type Box -->
          <div class="mt-4 bg-white p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Ticket Types</h3>
            <div class="space-y-2">
              @foreach ($t->ticketTypes ?? [] as $type)
                <div class="flex items-center justify-between p-3 bg-gray-100 rounded hover:bg-blue-50 transition">
                  <span class="text-gray-700">{{ $type->name }}</span>
                  <span class="font-medium text-blue-600">{{ currency_format($type->price) }}</span>
                </div>
              @endforeach

              @if(empty($t->ticketTypes) || count($t->ticketTypes) === 0)
                <p class="text-gray-500 italic">No ticket types available.</p>
              @endif
            </div>
          </div>
          <!-- end ticket type box -->
        </div>
      @endforeach
    </div>
  </div>
@endsection
