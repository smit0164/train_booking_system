<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'User Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-blue-700 hover:text-blue-800 transition">
                MyApp
            </a>

            <!-- Search Box -->
           <form method="GET" action="" class="relative w-full max-w-md mx-auto md:mx-0">
            <label for="search" class="sr-only">Search</label>
            <input
                type="text"
                name="query"
                id="search"
                placeholder="Search By Train name,code,..."
                autofocus
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            />
            <button
                type="submit"
                class="absolute inset-y-0 right-0 flex items-center px-4 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
            </form>


            <!-- User Links -->
            <div class="flex items-center space-x-6 text-sm md:text-base">
                @auth('user')
                    <span class="text-gray-700 font-medium truncate max-w-xs" title="{{ Auth::guard('user')->user()->email }}">
                        {{ Auth::guard('user')->user()->email }}
                    </span>
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <button type="submit" 
                                class="text-red-600 hover:text-red-800 font-semibold transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('user.login') }}" class="text-blue-600 hover:underline font-semibold">Login</a>
                    <a href="{{ route('user.register') }}" class="text-blue-600 hover:underline font-semibold">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-6 py-8 max-w-7xl">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner py-6 text-center text-gray-500 text-sm select-none">
        &copy; {{ date('Y') }} MyApp. All rights reserved.
    </footer>

</body>
</html>
