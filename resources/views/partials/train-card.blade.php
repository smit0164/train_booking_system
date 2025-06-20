@php
  use Carbon\Carbon;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
  @foreach ($trains as $train)
    @php
      $startTime = isset($train['start-time']) ? Carbon::parse($train['start-time'])->format('h:i A') : 'N/A';
      $endTime = isset($train['end-time']) ? Carbon::parse($train['end-time'])->format('h:i A') : 'N/A';
      $date = isset($train->date) ? Carbon::parse($train->date)->format('F j, Y') : 'N/A';
    @endphp

    <div class="bg-white border rounded-lg shadow hover:shadow-lg transition-shadow flex flex-col justify-between">
      <div class="p-6 space-y-4">
        <!-- Train Header -->
        <div>
          <h2 class="text-2xl font-bold text-blue-700 uppercase mb-1">{{ $train->name ?? 'Train Name' }}</h2>
          <p class="text-gray-600 font-semibold">Code: <span class="font-normal">{{ $train->code ?? 'Code' }}</span></p>
          <p class="text-gray-600 font-semibold">Start Time: <span class="font-normal">{{ $startTime }}</span></p>
          <p class="text-gray-600 font-semibold">End Time: <span class="font-normal">{{ $endTime }}</span></p>
          <p class="text-gray-600 font-semibold">Date: <span class="font-normal">{{ $date }}</span></p>
        </div>

        <!-- Route Info -->
        <div>
          <p class="text-gray-700 font-semibold mb-2">Route Name:</p>
          @if($train->route)
            <table class="table-auto border-collapse border border-gray-300 w-full text-sm rounded">
              <thead class="bg-gray-100">
                <tr>
                  <th class="border border-gray-300 px-4 py-2 text-left">Route Name</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Total Distance</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border border-gray-300 px-4 py-2">{{ $train->route->name ?? 'Route Name Not Available' }}</td>
                  <td class="border border-gray-300 px-4 py-2">{{ $train->route->total_distances ?? '0 KM' }}</td>
                </tr>
              </tbody>
            </table>
          @else
            <p class="text-gray-500 italic">Route is Not available</p>
          @endif
        </div>

        <!-- Classes Table -->
        <div>
          <p class="text-gray-700 font-semibold mb-2">Classes:</p>
          @if($train->trains_class->isEmpty())
            <p class="text-gray-500 italic">Class is not available on this train</p>
          @else
            <table class="w-full text-sm border border-gray-200 rounded">
              <thead class="bg-gray-100">
                <tr>
                  <th class="border border-gray-200 px-3 py-1 text-left">Name</th>
                  <th class="border border-gray-200 px-3 py-1 text-center">Total</th>
                  <th class="border border-gray-200 px-3 py-1 text-center">Available</th>
                </tr>
              </thead>
              <tbody>
                @foreach($train->trains_class as $class)
                  <tr>
                    <td class="border border-gray-200 px-3 py-1">{{ $class->name }}</td>
                    <td class="border border-gray-200 px-3 py-1 text-center">{{ $class->total_count }}</td>
                    <td class="border border-gray-200 px-3 py-1 text-center">{{ $class->available_count }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>

        <!-- Stations Table -->
        <div>
          <p class="text-gray-700 font-semibold mb-2">Stations:</p>
          @if($train->Train_Schedule_per_stations->isEmpty())
            <p class="text-gray-500 italic">Stations are not available on this train</p>
          @else
            <table class="w-full text-sm border border-gray-200 rounded">
              <thead class="bg-gray-100">
                <tr>
                  <th class="border border-gray-200 px-3 py-1 text-left">Station Name</th>
                  <th class="border border-gray-200 px-3 py-1 text-center">Arrival</th>
                  <th class="border border-gray-200 px-3 py-1 text-center">Departure</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($train->Train_Schedule_per_stations as $station)
                  <tr>
                    <td class="border border-gray-200 px-3 py-1">{{ $station->station->name ?? 'N/A' }}</td>
                    <td class="border border-gray-200 px-3 py-1 text-center">{{ $station->arrival_time ?? '-' }}</td>
                    <td class="border border-gray-200 px-3 py-1 text-center">{{ $station->departure_time ?? '-' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>

      <!-- Book Now Button -->
      <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg text-center">
        <a href="{{ route('user.view.train.book', $train->id) }}" 
          class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
          Book Now
        </a>
      </div>
    </div>
  @endforeach
</div>
