@extends('layouts.admin')
@section('title', 'Add Route')
@section('content')
<div class="container mx-auto p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Add New Route</h2>
    </div>
 

    <form action="{{route('admin.route_info.store')}}" method="POST" class="bg-white border border-gray-200 rounded-lg shadow-md p-6 space-y-4 w-full max-w-2xl" id="routeform">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Route Name</label>
            <input type="text" name="name" id="name" 
             value="{{ old('name') }}"
             class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror" >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="total_distances" class="block text-sm font-medium text-gray-700 mb-1">Total distances</label>
            <input type="number" name="total_distances" id="total_distances" 
               value="{{old('total_distances')}}"
                class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300
            @error('total_distances') border-red-500 @enderror">
            @error('total_distances')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <p>Select the stations (in desired order):</p>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;" >
            @foreach($station_list as $station)
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        name="station_ids[]" 
                        id="{{ $station->id}}"
                        data-station-name="{{ $station->name }}" 
                        data-station-id="{{$station->id}}"
                        value="{{ $station->id }}"  
                        class="station"
                         {{ in_array($station->id, old('station_ids', [])) ? 'checked' : '' }}
                    >
                    <label for="{{ $station->id }}">
                        {{ $station->name}}
                    </label>
                </div>
            @endforeach
        </div>
        @error('orders_json')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <input type="hidden" name="orders_json" id="orders_json">
        <div id="my-box"class="w-fit h-fit p-4 bg-gray-200 border border-gray-400 rounded shadow-md"></div>
        <div class="pt-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                Add Route
            </button>
            <a href="{{ route('admin.station_info.index') }}" class="ml-4 text-gray-600 hover:underline text-sm">
                Cancel
            </a>
        </div>
    </form>
<script>
  const stations = document.querySelectorAll('.station');
  let orders=[];
  stations.forEach(station => {
    station.addEventListener("click", function(event) {
      const el = event.currentTarget;
      if(el.checked){
          const stationId   = el.dataset.stationId;
          const stationName = el.dataset.stationName;
          orders.push(stationId);
          addStationForPreview(stationId,stationName);
      }else{
          const stationId   = el.dataset.stationId;
          const stationName = el.dataset.stationName;
          orders=orders.filter((order)=>{
              return order!=stationId;
          })
           removeStationFromPreview(stationId,stationName);
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
function  removeStationFromPreview(stationId, stationName){
      const previewStations=document.querySelectorAll('.previewStation');
      previewStations.forEach(previewStation=>{
          if(previewStation.id==stationId){
              previewStation.remove();
          }
      })

}
const form = document.getElementById('routeform');
const ordersInput = document.getElementById('orders_json');

form.addEventListener('submit', function() {
  ordersInput.value = JSON.stringify(orders);
});

document.addEventListener("DOMContentLoaded", function() {
  const checks = document.querySelectorAll('.station');
   checks.forEach(check => {
    if (check.checked) {
      const stationId = check.dataset.stationId;
      const stationName = check.dataset.stationName;
      orders.push(stationId);
      addStationForPreview(stationId, stationName);
    }
  });
});


</script>


</div>
@endsection
