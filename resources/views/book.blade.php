@extends('layouts.user')

@section('title', 'Book Train')

@section('content')
  <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6">Book Train: {{ $train->name ?? 'Train Name' }}</h1>

    <div class="mb-6">
      <p><strong>Train Code:</strong> {{ $train->code ?? 'N/A' }}</p>
      <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($train->date)->format('F j, Y') ?? 'N/A' }}</p>
      <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($train['start-time'])->format('h:i A') ?? 'N/A' }}</p>
      <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($train['end-time'])->format('h:i A') ?? 'N/A' }}</p>
    </div>

    <form action="" method="POST" class="space-y-6">
      @csrf

      <p class="font-semibold text-gray-700 mb-2">Select Classes and Number of Seats</p>

      @foreach ($train->trains_class as $class)
        <div class="flex items-center space-x-4">
          <label class="flex-1 text-gray-800">
            <input type="checkbox" name="{{$class->name}}" value="0" class="mr-2" data-class-id="{{$class->id}}">
            {{ $class->name }} (Available: {{ $class->available_count }})
          </label>
          <input
            type="number"
            id="count-{{$class->id}}"
            name="count-{{$class->name}}"
            min="1"
            max="{{ $class->available_count }}"
            disabled
            class="w-20 border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
      @endforeach

      <button type="submit"
        class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition">
        Book Now
      </button>
    </form>

<script>
  // Enable/disable count input based on checkbox
  document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function(e) {
        let currentElement=e.target;
        let id=currentElement.getAttribute('data-class-id');
        let inputElement=document.getElementById(`count-${id}`);
        if(currentElement.checked){
          inputElement.disabled = false; // This enables the input
          inputElement.value=1;
          inputElement.focus();
        }else{
          inputElement.disabled = true;
          inputElement.value="";
          inputElement.blur();
        }
        console.log(inputElement);
  });
})
</script>

  </div>
@endsection
