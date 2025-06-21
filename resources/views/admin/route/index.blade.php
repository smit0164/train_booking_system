@extends('layouts.admin')

@section('title', 'Route Information')

@section('content')
<div class="container mx-auto p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Route Information</h2>
    <a href="{{ route('admin.route_info.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 transition duration-200">
      + Add Route
    </a>
  </div>

  <!-- Total Routes -->
  <div class="mb-4">
    <p class="text-base text-gray-700">
      Total Routes: <span class="font-bold text-gray-900">{{ $route_stations->count() }}</span>
    </p>
  </div>

  <!-- Routes Table -->
  <div class="overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full bg-white border border-indigo-100">
      <thead class="bg-indigo-50 text-gray-700 text-sm">
        <tr>
          <th class="py-3 px-4 border-b border-indigo-100 text-left">Name</th>
          <th class="py-3 px-4 border-b border-indigo-100 text-left">Total Distance (km)</th>
          <th class="py-3 px-4 border-b border-indigo-100 text-left">Stations</th>
          <th class="py-3 px-4 border-b border-indigo-100 text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm text-gray-800">
        @forelse($route_stations as $route)
        <tr class="hover:bg-indigo-50 transition">
          <td class="py-2 px-4 border-b border-gray-100">{{ $route->name }}</td>
          <td class="py-2 px-4 border-b border-gray-100">{{ $route->total_distances }}</td>
          <td class="py-2 px-4 border-b border-gray-100">
            @if($route->stations->isNotEmpty())
            <ul class="list-disc list-inside space-y-1">
              @foreach($route->stations as $station)
              <li>{{$station->pivot->orderOfstations}}-{{ $station->name }}</li>
              @endforeach
            </ul>
            @else
            <span class="text-gray-500 italic">No stations</span>
            @endif
          </td>
          <td class="py-2 px-4 border-b border-gray-100 text-center">
            <a href="{{route('admin.route_info.edit',$route->id)}}"
               class="text-indigo-600 hover:text-indigo-800 px-2">Edit</a>
            <form action="{{route('admin.route_info.destroy',$route->id)}}"
                  method="POST" class="inline-block"
                  onsubmit="return confirm('Are you sure you want to delete this route?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="text-red-600 hover:text-red-800 px-2 transition">
                Delete
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="py-4 text-center text-gray-500 italic">
            No routes found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
    {{ $route_stations->links() }}
  </div>
</div>
@endsection
