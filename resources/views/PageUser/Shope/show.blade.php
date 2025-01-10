<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Shpe</h1>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-5">
        <!-- Product Image Section -->
        <div class="flex flex-col items-center">
            <img id="main-image" src="{{ asset('storage/' . $product->image1_url) }}" alt="{{ $product->product_name }}"
                class="w-40 h-30 object-cover border rounded-lg">
            <div class="flex space-x-4 mt-4">
                @foreach (['image2_url', 'image3_url', 'image4_url', 'image5_url'] as $image)
                    @if (!empty($product->$image))
                        <img src="{{ asset('storage/' . $product->$image) }}" alt="{{ $product->product_name }}"
                            class="thumbnail w-16 h-16 object-cover border rounded-lg cursor-pointer">
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Product Details Section -->
        <div>
            <ul class="mt-4 space-y-2">
                <li><strong>Nama</strong>: {{ $product->product_name }}</li>
                <li><strong>Jenis Kue</strong>: {{ optional($product->category)->category_name ?? 'No Category' }}</li>
            </ul>

            <!-- Price Section with Discount -->
            <div class="flex items-center mt-4 space-x-2">
                @if($product->discount)
                    <span class="line-through text-gray-500 text-lg">
                        Rp{{ number_format($product->price, 3, ',', '.') }}
                    </span>
                    <span class="text-red-500 text-2xl font-bold">
                        Rp{{ number_format($product->price - ($product->price * $product->discount->percentage / 100), 3, ',', '.') }}
                    </span>
                @else
                    <span class="text-green-500 text-2xl font-bold" id="price">
                        Rp{{ number_format($product->price, 3, ',', '.') }}
                    </span>
                @endif
            </div>

            <div class="mt-4">
                <span class="font-bold">Size/Weight:</span>
                <div class="flex space-x-2 mt-2">
                    <button class="px-4 py-2 bg-gray-100 rounded-md">50kg</button>
                </div>
            </div>

            <!-- Add to Cart Section -->
            <div class="mt-6 flex items-center space-x-4">

                <div class="flex items-center border rounded-md">
                    <button class="px-3 py-2" onclick="updateQuantity(-1)">-</button>
                    <input type="text" id="quantityInput" value="1" class="w-10 text-center border-l border-r" readonly>
                    <button class="px-3 py-2" onclick="updateQuantity(1)">+</button>
                </div>

                <!-- Wishlist Button -->
                <div class="mt-0">
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-pink-500 text-white font-semibold rounded-md hover:bg-pink-600">
                            ♥
                        </button>
                    </form>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" onsubmit="setQuantity(this)">
                    @csrf
                    <input type="hidden" name="quantity" id="quantityField" value="1">
                    <button type="submit" class="px-6 py-2 bg-orange-500 text-white font-semibold rounded-md">Add To
                        Cart</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="m-8 bg-white shadow-md rounded-lg p-6">
        <!-- Description Section -->
        <div class="mt-4 mb-8">
            <p class="text-gray-700">
                <strong>Deskripsi:</strong>
                {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
            </p>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('reviews.create', $product->id) }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold">
                Add Review
            </a>
        </div>
        <!-- Review List -->
        <div class="text-2xl font-semibold mb-4">Reviews</div>
        @forelse ($reviews as $review)
            <div class="border-b border-gray-200 pb-4 mb-4">
                <div class="flex items-center mb-2">
                    <p><strong>{{ $review->customers->name ?? 'Zaldi' }}</strong> memberikan rating: {{ $review->rating }}
                    </p>
                    <span class="text-yellow-500 text-lg">
                        {!! str_repeat('★', $review->rating) !!}
                        {!! str_repeat('☆', 5 - $review->rating) !!}
                    </span>
                </div>
                <p class="text-gray-800">{{ $review->comment }}</p>
                <p class="text-sm text-gray-500 mt-2">Reviewed on {{ $review->created_at->format('d M Y') }}</p>
            </div>
        @empty
            <p class="text-gray-600">No reviews yet for this product.</p>
        @endforelse
    </div>

    <script>
        function updateQuantity(amount) {
            const input = document.getElementById('quantityInput');
            let currentValue = parseInt(input.value);
            currentValue = Math.max(1, currentValue + amount);
            input.value = currentValue;

            document.getElementById('quantityField').value = currentValue;

            const price = {{ $product->price }};
            const discount = {{ $product->discount ? $product->discount->percentage : 0 }};
            const discountedPrice = price - (price * discount / 100);
            const totalPrice = currentValue * discountedPrice;
            document.getElementById('price').innerText = 'Rp' + totalPrice.toLocaleString('id-ID');
        }
    </script>
</x-app-layout>