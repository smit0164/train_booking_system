<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Admin Dashboard')</title>
  @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 font-sans">

  <div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-indigo-600 via-indigo-700 to-purple-700 text-white shadow-xl flex flex-col fixed inset-y-0 left-0 z-30">
      @include('admin.partials.sidebar')
    </aside>

    <!-- Main content wrapper -->
    <div class="flex-1 flex flex-col ml-64">

      <!-- Header -->
      <header class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shadow-md z-20">
        @include('admin.partials.header')
      </header>

      <!-- Main content -->
      <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
        @yield('content')
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t border-gray-200 px-6 py-3 text-center text-sm text-gray-600">
        @include('admin.partials.footer')
      </footer>

    </div>
  </div>

</body>
</html>
