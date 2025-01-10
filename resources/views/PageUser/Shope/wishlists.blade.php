<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Shop</h1>
    </x-slot>

    <!-- Main Carousel Section -->
    <div id="main-carousel" class="relative w-full p-4 rounded-lg" data-carousel="slide">
        <div class="relative w-full h-56 rounded-lg overflow-hidden">
            @foreach (['carousel.jpg', 'carousel2.jpg', 'carousel3.jpg', 'carousel4.jpg', 'carousel5.jpg'] as $index => $image)
                <div class="{{ $index === 0 ? 'block' : 'hidden' }} duration-700 ease-in-out"
                    data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('images/' . $image) }}" class="absolute block w-full h-full object-cover rounded-lg"
                        alt="Carousel image">
                </div>
            @endforeach
        </div>
    </div>

    @if(session('error'))
        <div
            class="max-w-4xl mx-auto mt-5 mb-4 p-4 bg-green-100 border border-red-500 text-green-700 rounded-lg shadow-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 8v4m0 4v4m-4-4h8M6 6h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z">
                </path>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Product Cards Section -->
    <div class="lg:grid gap-4">
        <!-- Search Form -->
        <div class="bg-orange-800 p-8 shadow-lg">
            <div class="mt-6 max-w-2xl mx-auto">
                <form method="GET" action="{{ route('search') }}" class="flex items-center space-x-2">
                    <input type="text" name="query"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Cari produk..." value="{{ request('query') }}">
                    <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition duration-200">Cari</button>
                </form>
            </div>
        </div>
        <!-- Wishlist Section -->
        <div class=" mx-auto mt-6 p-4">
            <h2 class="text-2xl font-bold mb-4">Your Wishlist</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($wishlists as $wishlist)
                                @php
                                    $product = $wishlist->product; // Mendapatkan produk dari relasi
                                @endphp
                                <div class="w-full bg-orange-100 rounded-lg shadow-lg overflow-hidden border border-gray-300">
                                    <!-- Carousel -->
                                    <div id="product-carousel-{{ $product->id }}" class="relative w-full" data-carousel="slide">
                                        <div class="relative p-4 h-40 md:h-40 lg:h-50 overflow-hidden rounded-lg">
                                            @foreach (range(1, 5) as $index)
                                                @if ($product->{'image' . $index . '_url'})
                                                    <div class="{{ $loop->first ? 'block' : 'hidden' }} duration-700 ease-in-out"
                                                        data-carousel-item="{{ $loop->first ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $product->{'image' . $index . '_url'}) }}"
                                                            class="absolute block w-full h-full object-cover" alt="Product image {{ $index }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Info -->
                                    <div class="px-5 pb-5 mt-4">
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
                                                    <span class="text-lg font-bold text-red-500">
                                                        Rp{{ number_format($discountedPrice, 2) }}
                                                    </span>
                                                    <span class="line-through text-gray-500">
                                                        Rp{{ number_format($product->price, 2) }}
                                                    </span>
                                                    <span class="text-sm text-green-500">
                                                        -{{ $product->discount->percentage }}%
                                                    </span>
                                                </div>
                                            @else
                                                <span class="text-2xl font-bold text-gray-900">
                                                    Rp{{ number_format($product->price, 3, ',', '.') }}
                                                </span>
                                            @endif

                                            <a href="{{ route('show.shop', ['id' => $product->id]) }}">
                                                <button class="ml-2 bg-orange-500 text-white rounded-lg px-4 py-2 text-sm">
                                                    Buy
                                                </button>
                                            </a>

                                            <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to remove this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 ml-3 py-1.5 bg-gray-500 text-white font-semibold rounded-md hover:bg-gray-600">
                                                    ♥
                                                </button>
                                            </form>
                                        </div>

                                        <div class="flex items-center mt-2 mb-4">
                                            <span class="ml-1 text-sm font-semibold text-gray-900">
                                                Stok: {{ $product->stok_quantity }}
                                            </span>
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

</x-app-layout>