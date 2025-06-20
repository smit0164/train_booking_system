@extends('layouts.user')
@php
use Carbon\Carbon;
@endphp

@section('title', 'User Dashboard')

@section('content')
  <div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-4xl font-bold mb-6">Welcome, {{ Auth::guard('user')->user()->name ?? 'smit' }}!</h1>
    <p class="text-gray-600 mb-10">This is your dashboard where you can book a train.</p>
    <a href="{{route('user.ticket',Auth::guard('user')->user()->id)}}" class="inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-medium mb-1">
      View My Booked Tickets
    </a>
     <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
       <select
        id="start-station-select"
        name="start_station"
        class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="">Select Start Station</option>
        @foreach($stations as $station)
          <option value="{{ $station->id }}">{{ $station->name }}</option>
        @endforeach
      </select>
        <select
        id="end-station-select"
        name="end_station"
        class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="">Select End Station</option>
        @foreach($stations as $station)
          <option value="{{ $station->id }}">{{ $station->name }}</option>
        @endforeach
      </select>
    </div>
    <div id="train-cards-container">
      @include('partials.train-card', ['trains' => $trains])
    </div>
  </div>
  <script>
  document.getElementById('search-input').addEventListener('input', function(e) {
    e.preventDefault();
    let query = document.getElementById('search-input').value;
    fetch(`/search?query=${encodeURIComponent(query)}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest' 
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not OK');
      }
      return response.text();
    })
    .then(html => {
      document.getElementById('train-cards-container').innerHTML = html;
    })
    .catch(error => {
      console.error('Fetch error:', error);
      alert('Something went wrong while searching. Please try again.');
    });
  });
  function fetchTrains() {
  const startStationId = document.getElementById('start-station-select').value;
  const endStationId = document.getElementById('end-station-select').value;

  // Construct query string correctly with &
  const url = `/search?startStationId=${encodeURIComponent(startStationId)}&endStationId=${encodeURIComponent(endStationId)}`;

  fetch(url, {
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not OK');
    }
    return response.text();
  })
  .then(html => {
    document.getElementById('train-cards-container').innerHTML = html;
  })
  .catch(error => {
    console.error('Fetch error:', error);
    alert('Something went wrong while searching. Please try again.');
  });
}

   document.getElementById('start-station-select').addEventListener('change', fetchTrains);
   document.getElementById('end-station-select').addEventListener('change', fetchTrains);

   
</script>

@endsection
