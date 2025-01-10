<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Checkout</h1>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Order Summary</h2>
            <!-- Cart items summary -->
            <ul class="divide-y divide-gray-200">
                @php $totalPrice = 0; @endphp
                @forelse (session('cart', []) as $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $totalPrice += $itemTotal;
                    @endphp
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900">{{ $item['product_name'] }}</p>
                            <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                            <p class="text-sm text-gray-600">Subtotal: Rp{{ number_format($itemTotal, 3, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Remove</button>
                        </form>
                    </li>
                @empty
                    <li class="py-4 text-center text-gray-500">Your cart is empty.</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-8 bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Shipping Information</h2>
            <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @csrf

                <!-- Nama Customer -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $customer->name ?? '') }}"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring focus:ring-orange-300 @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $customer->address1 ?? '') }}"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring focus:ring-orange-300 @error('address') border-red-500 @enderror"
                        required>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $customer->phone ?? '') }}"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring focus:ring-orange-300 @error('phone') border-red-500 @enderror"
                        required>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order Date -->
                <div>
                    <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date</label>
                    <input type="datetime-local" id="order_date" name="order_date"
                        value="{{ old('order_date', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring focus:ring-orange-300 @error('order_date') border-red-500 @enderror"
                        required>
                    @error('order_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="payment_method" name="payment_method"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('payment_method') border-red-500 @enderror"
                        required>
                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>COD</option>
                    </select>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="col-span-2 mt-6 bg-orange-500 text-white px-6 py-3 rounded-md font-bold hover:bg-orange-600 focus:ring-2 focus:ring-orange-300">
                    Confirm Order
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
