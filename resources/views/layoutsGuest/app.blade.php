<div class="min-h-screen flex flex-col bg-dots-darker bg-center bg-dots-lighter selection:bg-red-500 selection:text-white">
        
        <!-- Navbar -->
        <nav class="fixed top-0 left-0 right-0 z-10 bg-white dark:bg-orange-800 shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
                
                <!-- Burger Icon -->
                <div class="lg:hidden">
                    <button id="burger-menu" class="text-gray-700 dark:text-gray-200 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation links for large screens -->
                <div class="hidden lg:flex ml-8 space-x-4">
                    <a href="{{ url('/') }}" class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Home</a>
                    <a href="#" class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Contact</a>
                    <a href="#" class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Others</a>
                    <a href="#" class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Discount</a>
                </div>

                <!-- Login and Register buttons -->
                <div id="mode-toggle" class="hidden lg:flex text-gray-900 dark:text-gray-400 focus:outline-none space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Register</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu (hidden by default) -->
            <div id="mobile-menu" class="lg:hidden hidden px-6 pb-4">
                <a href="{{ url('/') }}" class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Home</a>
                <a href="#" class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Contact</a>
                <a href="#" class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Others</a>
                <a href="#" class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Discount</a>

                <!-- Login/Register buttons for mobile -->
                <div class="mt-4 space-y-2">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content Section -->
        <div class="text-center mt-24 mx-auto max-w-4xl p-8 bg-white bg-opacity-5 rounded-lg shadow-lg">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang Di Toko Kami!</h1>
            <p class="text-gray-700 mb-6">
                We're glad to have you here. Explore our site and discover amazing content created just for you.
            </p>
            <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}">
                <button class="px-6 py-2 font-semibold text-white bg-orange-900 rounded hover:bg-orange-500 transition duration-200">
                    Get Started
                </button>
            </a>
        </div>
    </div>