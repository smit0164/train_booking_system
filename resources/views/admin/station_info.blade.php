@extends('layouts.admin')

@section('title', 'Station Information')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Station Information</h2>
            <a href=""
               class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 transition duration-200">
                Add Station
            </a>
        </div>

        <!-- Total Stations -->
        <div class="mb-4">
            <p class="text-base text-gray-700">Total Stations: <span class="font-bold text-gray-900">3</span></p>
        </div>

        <!-- Stations Table -->
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full bg-white border border-indigo-100">
                <thead class="bg-indigo-50 text-gray-700 text-sm">
                    <tr>
                        <th class="py-3 px-4 border-b border-indigo-100 text-left">Station Name</th>
                        <th class="py-3 px-4 border-b border-indigo-100 text-left">Station Code</th>
                        <th class="py-3 px-4 border-b border-indigo-100 text-left">Total Platforms</th>
                        <th class="py-3 px-4 border-b border-indigo-100 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="py-2 px-4 border-b border-gray-100">Ahmedabad Junction</td>
                        <td class="py-2 px-4 border-b border-gray-100">ADI</td>
                        <td class="py-2 px-4 border-b border-gray-100">8</td>
                        <td class="py-2 px-4 border-b border-gray-100 text-center">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 px-2">Edit</a>
                            <form action="#" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 px-2 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="py-2 px-4 border-b border-gray-100">Mumbai Central</td>
                        <td class="py-2 px-4 border-b border-gray-100">MMCT</td>
                        <td class="py-2 px-4 border-b border-gray-100">16</td>
                        <td class="py-2 px-4 border-b border-gray-100 text-center">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 px-2">Edit</a>
                            <form action="#" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 px-2 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="py-2 px-4 border-b border-gray-100">Delhi Hazrat Nizamuddin</td>
                        <td class="py-2 px-4 border-b border-gray-100">NZM</td>
                        <td class="py-2 px-4 border-b border-gray-100">12</td>
                        <td class="py-2 px-4 border-b border-gray-100 text-center">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 px-2">Edit</a>
                            <form action="#" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 px-2 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
