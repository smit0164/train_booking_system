<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'User Dashboard')</title>
   @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">MyApp</a>

            <!-- Search Box -->
            <form method="GET" action="" class="flex">
                <input type="text" name="query" placeholder="Search..."
                    class="px-3 py-1 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <button type="submit"
                    class="bg-blue-600 text-white px-4 rounded-r-md hover:bg-blue-700 transition">
                    Search
                </button>
            </form>

            <!-- User Links -->
            <div class="flex items-center space-x-4">
                @auth('user')
                    <span class="text-gray-700"><strong>{{ Auth::guard('user')->user()->email }}</strong></span>
                    <form method="POST" action="{{route('user.logout')}}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{route('user.login')}}" class="text-blue-600 hover:underline">Login</a>
                    <a href="{{route('user.register')}}" class="text-blue-600 hover:underline">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shad
    ow-inner py-4 text-center text-gray-600 text-sm">
        &copy; {{ date('Y') }} MyApp. All rights reserved.
    </footer>

</body>
</html>
