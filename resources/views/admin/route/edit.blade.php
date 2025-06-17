@extends('layouts.admin')
@section('title', 'Edit Route')
@section('content')
<div class="container mx-auto p-6">
  <div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Edit Route</h2>
  </div>

  <form action="{{route('admin.route_info.update',$routeinfo->id)}}" method="POST"
        class="bg-white border border-gray-200 rounded-lg shadow-md p-6 space-y-4 max-w-2xl"
        id="routeform">
    @csrf
    @method('PUT')

    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Route Name</label>
      <input type="text" name="name" id="name" value="{{ old('name', $routeinfo->name) }}"
             class="w-full border rounded-md px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="total_distances" class="block text-sm font-medium text-gray-700 mb-1">Total Distance</label>
      <input type="number" name="total_distances" id="total_distances"
             value="{{ old('total_distances', $routeinfo->total_distances) }}"
             class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('total_distances') border-red-500 @enderror">
      @error('total_distances')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <p>Select stations (in desired order):</p>
    <div class="grid grid-cols-3 gap-2">
      @foreach($station_list as $station)
        <div class="flex items-center space-x-2">
          <input type="checkbox" name="station_ids[]" 
                 data-station-name="{{ $station->name }}"
                 data-station-id="{{ $station->id }}"
                 id="{{ $station->id }}"
                 value="{{ $station->id }}"
                 class="station checkbox"
                 {{ in_array($station->id, old('station_ids', $currentStation)) ? 'checked' : '' }}>
          <label for="{{ $station->id }}" class="text-gray-700">{{ $station->name }}</label>
        </div>
      @endforeach
    </div>
    @error('orders_json')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    <input type="hidden" name="orders_json" id="orders_json">

     <div id="my-box"class="w-fit h-fit p-4 bg-gray-200 border border-gray-400 rounded shadow-md"></div>

    <div class="flex space-x-4 pt-4">
      <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
        Update Route
      </button>
      <a href="{{ route('admin.route_info.index') }}" class="text-gray-600 hover:underline text-sm">
        Cancel
      </a>
    </div>
  </form>
</div>

<script>
  const stations = document.querySelectorAll('.station');
  let currentStation= @json($currentStation);
  let orders=[];
  stations.forEach(station => {
    station.addEventListener('change', e => {
      const { stationId, stationName } = e.target.dataset;
      if (e.target.checked) {
        orders.push(stationId);
        addStationForPreview(stationId, stationName);
      } else {
        console.log("stationId",stationId);
        orders = orders.filter(id => id != stationId);
        removeStationFromPreview(stationId);
      }
    });
  });
 function addStationForPreview(stationId, stationName) {
  const wrapper = document.createElement('div');
  wrapper.className = `flex flex-col items-center space-y-2 mt-2 previewStation`;
  wrapper.id=`${stationId}`;
  const circle = document.createElement('div');
  circle.className = 'flex flex-col items-center justify-center w-16 h-16 rounded-full bg-blue-500 text-white';
  circle.innerHTML = `<span class="font-bold">${stationId}</span><span class="text-xs">${stationName}</span>`;
  const arrow = document.createElement('div');
  arrow.className = 'w-0 h-0 border-x-4 border-x-transparent border-t-6 border-t-gray-500';
  wrapper.append(circle, arrow)
  document.getElementById('my-box').appendChild(wrapper);
}

function  removeStationFromPreview(stationId){
      const previewStations=document.querySelectorAll('.previewStation');
      previewStations.forEach(previewStation=>{
          if(previewStation.id==stationId){
              previewStation.remove();
          }
      })

}
  document.getElementById('routeform').addEventListener('submit', () => {
    document.getElementById('orders_json').value = JSON.stringify(orders);
  });
  document.addEventListener("DOMContentLoaded", function() {
  const cs = currentStation; 
  for (const key in cs) {
    orders.push(String(cs[key]));
    addStationForPreview(cs[key],key);
  }
});
</script>

@endsection
