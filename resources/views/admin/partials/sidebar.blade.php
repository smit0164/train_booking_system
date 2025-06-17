<aside class="w-64 bg-gradient-to-b from-white via-indigo-50 to-white text-black shadow-xl h-screen fixed inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

  <!-- Logo / Title -->
  <div class="px-6 py-4 border-b border-indigo-100">
    <h2 class="text-2xl font-bold tracking-wide select-none text-indigo-700">
      🚆 <span class="text-gray-900">RailSwift</span>
    </h2>
  </div>

  <!-- Navigation -->
  <nav class="mt-6">
    <ul class="space-y-1 px-4 text-sm font-medium">
      
      <li>
        <a href="{{ route('admin.station_info.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-800 hover:bg-indigo-100 transition-colors duration-200">
          <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8h..." />
          </svg>
          Manage Stations
        </a>
      </li>
       <li>
        <a href="{{ route('admin.route_info.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-800 hover:bg-indigo-100 transition-colors duration-200">
          <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8h..." />
          </svg>
          Manage Route
        </a>
      </li>
      <li>
        <a href="{{route('admin.train_info.index')}}"
           class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-800 hover:bg-indigo-100 transition-colors duration-200">
          <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16h..." />
          </svg>
          Manage Trains
        </a>
      </li>

    </ul>
  </nav>

</aside>
