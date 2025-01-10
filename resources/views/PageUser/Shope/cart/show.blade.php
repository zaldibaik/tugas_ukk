<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Cart</h1>
    </x-slot>

    <div class="container mx-auto p-5">
        @if(session('cart'))
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Your Cart</h2>
                <ul>
                    @php $totalPrice = 0; @endphp
                    @foreach(session('cart') as $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalPrice += $itemTotal;
                        @endphp
                        <li class="flex justify-between items-center border-b pb-4">
                            <div>
                                <p class="font-medium text-gray-900">Product: {{ $item['product_name'] }}</p>
                                <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                <p class="text-sm text-gray-600">Total: Rp{{ number_format($itemTotal, 3, ',', '.') }}</p>
                            </div>
                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-red-700 text-sm">Remove</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-6 text-lg font-semibold">
                    Total Price: Rp{{ number_format($totalPrice, 3, ',', '.') }}
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('sales.shop') }}" class="text-white px-6 py-2 rounded-md text-sm font-semibold bg-gray-600">
                        Back to Shop
                    </a>
                    <a href="{{ route('checkout.index') }}" class="bg-orange-500 text-white px-6 py-2 rounded-md text-sm font-semibold">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <p class="text-center text-gray-500 mt-6">Your cart is empty.</p>
        @endif
    </div>
</x-app-layout>
