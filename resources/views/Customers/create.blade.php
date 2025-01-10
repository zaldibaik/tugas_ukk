<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-orange-900">
        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-orange-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="mt-8 bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Shipping Information</h2>
                <form action="{{ route('customers.store') }}" method="POST"
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    @csrf
                    <div class="col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your Full Name"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="081234567890"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('phone') border-red-500 @enderror"
                            required>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="address1" class="block text-sm font-medium text-gray-700">Full Address</label>
                        <input type="text" id="address1" name="address1" value="{{ old('address1') }}"
                            placeholder="Street Address"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('address1') border-red-500 @enderror"
                            required>
                        @error('address1')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address2" class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" id="address2" name="address2" value="{{ old('address2') }}"
                            placeholder="Apartment, Suite, etc."
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('address2') border-red-500 @enderror">
                        @error('address2')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address3" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" id="address3" name="address3" value="{{ old('address3') }}"
                            placeholder="City"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('address3') border-red-500 @enderror"
                            required>
                        @error('address3')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="col-span-2 mt-6 bg-orange-500 text-white px-6 py-3 rounded-md font-bold hover:bg-orange-600 focus:ring-2 focus:ring-orange-300">
                        Confirm
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>