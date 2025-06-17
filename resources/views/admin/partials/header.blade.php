<header class="fixed top-0 left-0 right-0 z-40 h-16 ml-64 bg-gradient-to-r from-white via-indigo-50 to-white border-b border-indigo-100 px-6 flex items-center justify-between shadow-md">

  <!-- Page Title -->
  <h1 class="text-xl md:text-2xl font-bold tracking-wide text-gray-800 select-none">
    @yield('page_heading', 'Admin Panel')
  </h1>

  <!-- Auth Links -->
  <div class="flex items-center gap-4 text-sm">
    @auth
      <span class="text-gray-700">
        Welcome, <span class="font-semibold">{{ Auth::user()->name }}</span>
      </span>

      <a href="#" class="text-indigo-600 hover:underline transition">Profile</a>

      <form method="POST" action="#" class="inline">
        @csrf
        <button type="submit" class="text-red-600 hover:underline transition">Logout</button>
      </form>
    @else
      <a href="#" class="text-indigo-600 hover:underline transition">Login</a>
      <a href="#" class="text-indigo-600 hover:underline transition">Register</a>
    @endauth
  </div>

</header>
