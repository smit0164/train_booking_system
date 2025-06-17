@extends('layouts.admin')

@section('title', 'Add Station')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Add New Station</h2>
    </div>

    <form action="{{route('admin.station_info.store')}}" method="POST" class="bg-white border border-gray-200 rounded-lg shadow-md p-6 space-y-4 w-full max-w-2xl">
        @csrf
        <!-- Station Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Station Name</label>
            <input type="text" name="name" id="name" 
             value="{{ old('name') }}"
             class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror" >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Station Code -->
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Station Code</label>
            <input type="text" name="code" id="code" 
             value="{{ old('code') }}"
             class="w-full border border-gray-300 rounded-md px-4 py-2 uppercase focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('code') border-red-500 @enderror">
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Total Platforms -->
        <div>
            <label for="total_no_platforms" class="block text-sm font-medium text-gray-700 mb-1">Total Number of Platforms</label>
           <input type="number" name="total_no_platforms" id="total_no_platforms" min="1"
              value="{{ old('total_no_platforms') }}"
              class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300
           @error('total_no_platforms') border-red-500 @enderror">

            @error('total_no_platforms')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                Add Station
            </button>
            <a href="{{ route('admin.station_info.index') }}" class="ml-4 text-gray-600 hover:underline text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
