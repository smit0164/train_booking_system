@extends('layouts.admin')

@section('title', 'Edit Train Info')

@section('content')
<div class="container mx-auto p-6 train">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit The Train</h2>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route('admin.train_info.update',$train_info->id)}}" method="POST" class="bg-white border border-gray-200 rounded-lg shadow-md p-6 space-y-4 w-full max-w-2xl" id="routeForm">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Train Name</label>
            <input type="text" name="name" id="name" 
             value="{{ old('name',$train_info->name) }}"
             class="w-full border  rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror" >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
       
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Train Code</label>
            <input type="text" name="code" id="code" 
             value="{{ old('code',$train_info->code) }}"
             class="w-full border  rounded-md px-4 py-2  focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('code') border-red-500 @enderror">
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="start-time" class="block text-sm font-medium text-gray-700 mb-1">Starting Time:</label>
            <input type="time" name="start-time" id="start-time" 
            value="{{ old('start-time', \Carbon\Carbon::parse($train_info['start-time'])->format('H:i')) }}"
            class="w-full border rounded-md px-4 py-2 uppercase focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('start-time') border-red-500 @enderror">
            @error('start-time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
             @enderror
        </div>
        <div>
             <label for="end-time" class="block text-sm font-medium text-gray-700 mb-1">End Time:</label>
            <input type="time" name="end-time" id="end-time" 
            value="{{ old('end-time', \Carbon\Carbon::parse($train_info['end-time'])->format('H:i')) }}"
             class="w-full border  rounded-md px-4 py-2 uppercase focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('code') border-red-500 @enderror">
            @error('end-time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
         <div>
             <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="date" id="date" 
             value="{{ old('date', $train_info->date) }}"
             class="w-full border  rounded-md px-4 py-2 uppercase focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('code') border-red-500 @enderror">
            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
       <div>
    <label for="total_no_platforms" class="block text-lg font-semibold text-gray-800 mb-4">
        Available Routes(Only select One)
    </label>

    @if($routes->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($routes as $route)
                <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition routecard" data-route-id="{{$route->id}}" >
                    <h2 class="text-xl font-bold text-indigo-600 mb-2">{{ $route->name }}</h2>
                    <h3 class="text-sm text-gray-500 mb-4">Total Distance: {{ $route->total_distances }} km</h3>

                    <div class="space-y-1">
                        @forelse ($route->stations as $station)
                            <p class="text-gray-700 text-sm station-name" data-station-id="{{$station->id}}">📍 {{ $station->name }}</p>
                        @empty
                            <p class="text-gray-400 italic text-sm">No station available on this route.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">No routes are available.</p>
    @endif
    @error('route-id')
        <p class="text-red-500 text-sm mt-1">Please Select At List One Route</p>
    @enderror
</div>
    <input type="hidden" name="route-id" id="route-id" value="{{ old('route-id',$train_info['route-id']) }}">
    <input type="hidden" name="schedule_train_info" id="schedule_train_info" value="">
   <div id="train-classes-container">
    <div class="train-class-row flex items-center space-x-4 mb-2">
        <input 
            type="text" 
            name="class_name[]" 
            placeholder="Class Name"
            class="w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
        <input 
            type="number" 
            name="class_count[]" 
            placeholder="Seat Count"
            class="w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
        
    </div>
</div>

<button 
    type="button" 
    id="add-class-btn" 
    class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition"
>
    Add More Class
</button>

    <div class="pt-4">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
            Edit Train
        </button>
        <a href="{{ route('admin.train_info.index') }}" class="ml-4 text-gray-600 hover:underline text-sm">
            Cancel
        </a>
    </div>
</form>

</div>
<script>
let selected_count=0;
let routes=document.querySelectorAll('.routecard');
routes.forEach(route=>{
    route.addEventListener('click',function(event){
        let currentElement=event.currentTarget;
        console.log(currentElement)
        if(currentElement.classList.contains('bg-white') ){
            if(selected_count>0){
               return;
            }
            let routeId = currentElement.getAttribute('data-route-id');
            let collectRouteId = document.getElementById('route-id');
            collectRouteId.value=routeId;
            const stations = currentElement.querySelectorAll('.station-name');
            stations.forEach((station, index) => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('p-4', 'bg-gray-100', 'mb-4', 'rounded', 'shadow', 'dynamic-form');
               
                const stationName = station.textContent.trim();
                const stationId = station.getAttribute('data-station-id');

                // Station label
                const namePara = document.createElement('p');
                namePara.textContent = `Station ${index + 1}: ${stationName}`;
                namePara.classList.add('font-semibold', 'mb-2');
                wrapper.appendChild(namePara);

                // Arrival label + input
                const arrivalLabel = document.createElement('label');
                arrivalLabel.textContent = 'Arrival Time';
                wrapper.appendChild(arrivalLabel);

                const arrivalInput = document.createElement('input');
                arrivalInput.type = 'time';
                arrivalInput.setAttribute('data-station-id', stationId);
                arrivalInput.setAttribute('data-type', 'arrival_time');
                arrivalInput.classList.add('block', 'mb-2', 'w-full', 'p-2', 'border', 'rounded','schedule');
                arrivalInput.addEventListener('change', function () {
                    arrivalInput.setAttribute('value', arrivalInput.value);
                });
                wrapper.appendChild(arrivalInput);
 
                // Departure label + input
                const departureLabel = document.createElement('label');
                departureLabel.textContent = 'Departure Time';
                wrapper.appendChild(departureLabel);

                const departureInput = document.createElement('input');
                departureInput.type = 'time';
                departureInput.id = `station[${stationId}][departure_time]`;
                departureInput.setAttribute('data-station-id', stationId);
                departureInput.setAttribute('data-type', 'departure_time');
                departureInput.classList.add('block', 'mb-2', 'w-full', 'p-2', 'border', 'rounded','schedule');
                wrapper.appendChild(departureInput);
                document.querySelector('.train').appendChild(wrapper);
            });
            
            currentElement.classList.remove('bg-white');
            currentElement.classList.add('bg-gray-300');
            selected_count++;
        }else{
            let collectRouteId = document.getElementById('route-id');
            collectRouteId.value="";
            const forms = document.querySelectorAll('.dynamic-form');
            forms.forEach(form => form.remove());
            currentElement.classList.remove('bg-gray-300');
            currentElement.classList.add('bg-white');
            selected_count--;
        }
       
    
    })
 })
 let form= document.getElementById('routeForm');
 form.addEventListener('submit', function(event) {
    event.preventDefault();
    let schedule_data = {};
    let schedule_inputs = document.querySelectorAll('.schedule');
    schedule_inputs.forEach(schedule => {
        let stationId = schedule.getAttribute('data-station-id');
        let type = schedule.getAttribute('data-type');
        let value = schedule.value;
        if (!schedule_data[stationId]) {
            schedule_data[stationId] = {};
        }
        schedule_data[stationId][type] = value;
    });
    document.getElementById('schedule_train_info').value = JSON.stringify(schedule_data);
    form.submit();
});

 document.addEventListener("DOMContentLoaded", function() {
        let routeId=document.getElementById('route-id');
        if(routeId.value){
            let routes=document.querySelectorAll('.routecard');
            routes.forEach(route=>{
                   let route_id = route.getAttribute('data-route-id');
                   if(route_id==routeId.value){
                      if(route.classList.contains('bg-white')){
                          route.classList.remove('bg-white');
                          route.classList.add('bg-gray-100');
                          selected_count++;
                           const stations = route.querySelectorAll('.station-name');
                            stations.forEach((station, index) => {
                                const wrapper = document.createElement('div');
                                wrapper.classList.add('p-4', 'bg-gray-100', 'mb-4', 'rounded', 'shadow', 'dynamic-form');
                            
                                const stationName = station.textContent.trim();
                                const stationId = station.getAttribute('data-station-id');

                                // Station label
                                const namePara = document.createElement('p');
                                namePara.textContent = `Station ${index + 1}: ${stationName}`;
                                namePara.classList.add('font-semibold', 'mb-2');
                                wrapper.appendChild(namePara);

                                // Arrival label + input
                                const arrivalLabel = document.createElement('label');
                                arrivalLabel.textContent = 'Arrival Time';
                                wrapper.appendChild(arrivalLabel);

                                const arrivalInput = document.createElement('input');
                                arrivalInput.type = 'time';
                                arrivalInput.setAttribute('data-station-id', stationId);
                                arrivalInput.setAttribute('data-type', 'arrival_time');
                                arrivalInput.classList.add('block', 'mb-2', 'w-full', 'p-2', 'border', 'rounded','schedule');
                                arrivalInput.addEventListener('change', function () {
                                    arrivalInput.setAttribute('value', arrivalInput.value);
                                });
                                wrapper.appendChild(arrivalInput);
                
                                // Departure label + input
                                const departureLabel = document.createElement('label');
                                departureLabel.textContent = 'Departure Time';
                                wrapper.appendChild(departureLabel);

                                const departureInput = document.createElement('input');
                                departureInput.type = 'time';
                                departureInput.id = `station[${stationId}][departure_time]`;
                                departureInput.setAttribute('data-station-id', stationId);
                                departureInput.setAttribute('data-type', 'departure_time');
                                departureInput.classList.add('block', 'mb-2', 'w-full', 'p-2', 'border', 'rounded','schedule');
                                wrapper.appendChild(departureInput);
                                document.querySelector('.train').appendChild(wrapper);
                            });
                      }
                   }
            })
        }

        let scheduleInfo = @json($train_info->Train_Schedule_per_stations);
        let schedule=document.querySelectorAll('.schedule');
        schedule.forEach(s=>{
            let stationId=s.getAttribute('data-station-id');
            let type=s.getAttribute('data-type');
            
            let record = scheduleInfo.find(r => String(r.station_id) == stationId);
            if (record) {
                if(type=="arrival_time"){
                     let fetchArrivalTime=record.arrival_time;
                     s.value=fetchArrivalTime;
                }else{
                    let fetchArrivalTime=record.departure_time;
                     s.value=fetchArrivalTime;
                }
            } 
        });

        let trainClassInfo = @json($train_info->trains_class);
        let parent=document.getElementById('train-classes-container');
        parent.replaceChildren();
        trainClassInfo.forEach(a => {
            console.log(a);
            let html=`<div class="train-class-row flex items-center space-x-4 mb-2">
        <input 
            type="text" 
            name="class_name[]" 
            placeholder="Class Name"
            class="w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            value="${a.name}"
        />
        <input 
            type="number" 
            name="class_count[]" 
            placeholder="Seat Count"
            class="w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            value="${a.total_count}"
        />
       </div>
            `
            parent.insertAdjacentHTML('beforeend', html);
            
        });

});
document.getElementById('add-class-btn').addEventListener('click', function() {
  const container = document.getElementById('train-classes-container');
  const newRow = document.createElement('div');
  newRow.className = 'train-class-row flex items-center space-x-4 mb-2';

  newRow.innerHTML = `
    <input
      type="text" name="class_name[]" placeholder="Class Name"
      class="w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    />
    <input
      type="number" name="class_count[]" placeholder="Seat Count"
      class="w-1/2 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    />
  `;

  container.appendChild(newRow);
});

</script>
@endsection
