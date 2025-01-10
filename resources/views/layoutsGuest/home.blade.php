<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,900&display=swap" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-orange-100 text-gray-700">
    <div
        class="min-h-screen flex flex-col bg-dots-darker bg-center bg-dots-lighter selection:bg-red-500 selection:text-white">

        <!-- Navbar -->
        <nav class="fixed top-0 left-0 right-0 z-10 bg-white dark:bg-orange-800 shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <!-- Logo -->
                <div class="">
                    <a class="font-bold text-3xl text-gray-100" href="{{ url('/') }}">Cake Shop</a>
                </div>

                <!-- Burger Icon -->
                <div class="lg:hidden">
                    <button id="burger-menu" class="text-gray-700 dark:text-gray-200 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation links for large screens -->
                <div class="hidden lg:flex ml-8 space-x-4">
                    <a href="{{ url('/') }}"
                        class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Home</a>
                    <a href="#"
                        class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Contact</a>
                    <a href="#"
                        class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Others</a>
                    <a href="#"
                        class="text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Discount</a>
                </div>

                <!-- Login and Register buttons -->
                <div id="mode-toggle"
                    class="hidden lg:flex text-gray-900 dark:text-gray-400 focus:outline-none space-x-4">
                    @auth
                        <a href="{{ url('/shop') }}"
                            class="bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Shop</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Register</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu (hidden by default) -->
            <div id="mobile-menu" class="lg:hidden hidden px-6 pb-4">
                <a href="{{ url('/') }}"
                    class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Home</a>
                <a href="#"
                    class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Contact</a>
                <a href="#"
                    class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Others</a>
                <a href="#"
                    class="block py-2 text-sm font-semibold text-orange-400 hover:text-orange-900 dark:text-orange-200 dark:hover:text-white">Discount</a>

                <!-- Login/Register buttons for mobile -->
                <div class="mt-4 space-y-2">
                    @auth
                        <a href="{{ url('/shop') }}"
                            class="block bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Shop</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block bg-orange-100 text-sm font-semibold px-4 py-2 rounded-lg text-gray-900 dark:hover:text-orange-900">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>


        <!-- Hero Section (Gambar dengan Teks di Tengah) -->
        <div class="relative py-8 mt-15 md:mt-3">
            <img src="{{ asset('images/header.jpg') }}" alt="Header Image" class="w-full h-auto object-cover">
            <div
                class="absolute inset-0 flex items-center justify-center text-grey-900 text-1xl md:text-2xl font-bold shadow-lg">
                <div
                    class="mb-60 text-center md:mt-24 mt-60 mx-auto max-w-4xl p-8 bg-white bg-opacity-5 rounded-lg shadow-lg">
                    @if(session('error'))
                        <div
                            class="max-w-4xl mx-auto mt-5 mb-4 p-4 bg-green-100 border border-red-500 text-green-700 rounded-lg shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 8v4m0 4v4m-4-4h8M6 6h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z">
                                </path>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <h1 class="text-sm md:text-3xl font-bold mb-4">Selamat Datang Di Toko Kami!</h1>
                    <p class="text-gray-700 mb-6 hidden sm:block">
                        We're glad to have you here. Explore our site and discover amazing content created just for you.
                    </p>
                    <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}">
                        <button
                            class="md:px-6 md:py-2 px-2 py-1  font-semibold text-white bg-orange-900 rounded hover:bg-orange-500 transition duration-200">
                            Get Started
                        </button>
                    </a>
                </div>
                </a>
            </div>
        </div>
        <style>
        </style>


        <div id="main-carousel" class="relative w-full p-4 rounded-lg" data-carousel="slide">
            <div class="relative w-full h-56 h-56 rounded-lg">
                @foreach (['carousel.jpg', 'carousel2.jpg', 'carousel3.jpg', 'carousel4.jpg', 'carousel5.jpg'] as $image)
                    <div class="duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/' . $image) }}"
                            class="absolute block w-full h-full object-cover rounded-lg" alt="Carousel image">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md:text-5xl text-3xl text-center font-semibold">Products</div>

        <!-- Main Content Section -->
        <div class="lg:grid-row-3 gap-4">

            <!-- Product Grid -->
            <div class="col-span-2 p-4 mt-4">
                <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($products as $product)
                                        <div
                                            class="w-full bg-orange-100 rounded-lg shadow-lg overflow-hidden border border-gray-300 
                                                                                                                                    {{ 'kue-' . strtolower($product->category->category_name ?? 'no-category') }}">
                                            <!-- Product Carousel inside Card -->
                                            <div id="product-carousel-{{ $product->id }}" class="relative w-full" data-carousel="slide">
                                                <div class="relative p-4 h-40 md:h-40 lg:h-50 overflow-hidden rounded-lg">
                                                    @foreach (range(1, 5) as $index)
                                                        @if ($product->{'image' . $index . '_url'})
                                                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                                                <img src="{{ asset('storage/' . $product->{'image' . $index . '_url'}) }}"
                                                                    class="absolute block w-full h-full object-cover"
                                                                    alt="Product image {{ $index }}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Product Info -->
                                            <div class="px-5 pb-5 mt-4">
                                                <!-- Product Category Title -->
                                                <div class="text-2xl text-gray-600 font-bold text-center p-2">
                                                    {{ $product->product_name }}
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    @php
                                                        $hasDiscount = $product->discount && $product->discount->start_date <= now() && $product->discount->end_date >= now();
                                                        $discountedPrice = $hasDiscount ? $product->price * (1 - $product->discount->percentage / 100) : $product->price;
                                                    @endphp

                                                    @if ($hasDiscount)
                                                        <div>
                                                            <span
                                                                class="text-lg font-bold text-red-500">${{ number_format($discountedPrice, 2) }}</span>
                                                            <span
                                                                class="line-through text-gray-500">${{ number_format($product->price, 2) }}</span>
                                                            <span class="text-sm text-green-500">-{{ $product->discount->percentage }}%</span>
                                                        </div>
                                                    @else
                                                        <span
                                                            class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                    <a href="{{ route('show.shop', ['id' => $product->id]) }}">
                                                        <button class="bg-orange-500 text-white rounded-lg px-4 py-2 text-sm">Buy</button>
                                                    </a>
                                                </div>

                                                <div class="flex items-center mt-2 mb-4">
                                                    <span class="ml-1 text-sm font-semibold text-gray-900">Stok:
                                                        {{ $product->stok_quantity }}</span>
                                                </div>
                                                <a href="#">
                                                    <h5 class="text-lg md:text-xl font-semibold text-gray-900">
                                                        {{ optional($product->category)->category_name ?? 'No Category' }}
                                                    </h5>
                                                </a>

                                            </div>
                                        </div>
                    @endforeach
                </div>
            </div>


        </div>

        <script>
            // Toggle mobile menu visibility
            const burgerMenuButton = document.getElementById('burger-menu');
            const mobileMenu = document.getElementById('mobile-menu');

            burgerMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Toggle dark mode
            const modeToggleButton = document.getElementById('mode-toggle');
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }

            modeToggleButton.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            });
        </script>
</body>

</html>