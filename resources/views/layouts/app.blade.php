<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-orange-100">
        <!-- Main Layout (Flexbox Container) -->
        <div class="min-h-screen bg-orange-100 flex flex-col lg:flex-row">

            <!-- Sidebar (Navigation) -->
            <div x-data="{ open: false }" class="lg:w-64 bg-white dark:bg-orange-800 border-b lg:border-r border-orange-200 dark:border-orange-600 lg:flex lg:flex-col">
                
                <!-- Hamburger Button for Mobile -->
                <div class="lg:hidden p-4">
                    <button @click="open = !open" class="text-orange-500 dark:text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Sidebar Navigation for Mobile (toggle visibility on mobile) -->
                <div :class="{'block': open, 'hidden': !open}" class="lg:hidden">
                    @include('layouts.navigation')
                </div>

                <!-- Sidebar Navigation for Desktop (always visible on large screens) -->
                <div class="hidden lg:block">
                    @include('layouts.navigation')
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-orange-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                

                <!-- Page Content -->
                <main>
                    <div class="grid grid-row-2">
                    <!-- Render Slot Content -->
                    {{ $slot }}

                    <footer class="bg-orange bg-orange-800 rounded-lg shadow m-4">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <ul
                    class="flex flex-wrap items-center mt-3 text-sm font-medium text-orange-500 text-orange-400 sm:mt-0">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
        </footer>
        </div>
                </main>
            </div>
      

        <!-- Footer -->

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.1/dist/flowbite.js"></script>
</body>

</html>
