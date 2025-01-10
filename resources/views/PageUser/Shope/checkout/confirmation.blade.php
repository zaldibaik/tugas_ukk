<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Order Confirmation</h1>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Your Order Confirmation</h2>

            <div class="space-y-4">
                <!-- Order Details -->
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Order Details</h3>
                    <ul>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Order Number:</span>
                            <span class="text-gray-600">{{ $customers->id }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Name:</span>
                            <span class="text-gray-600">{{ $customers->name }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Phone:</span>
                            <span class="text-gray-600">{{ $customers->phone }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">City:</span>
                            <span class="text-gray-600">{{ $customers->address1 }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Address:</span>
                            <span class="text-gray-600">{{ $customers->address2 }}, {{ $customers->address3 }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Payment Method:</span>
                            <span class="text-gray-600">{{ ucfirst($customers->payment_method) }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Order Items -->
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Items in Your Order</h3>
                    <ul class="space-y-3">
                        @if($orderItems && $orderItems->isNotEmpty())
                            @foreach($orderItems as $orderItem)
                                <li class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">{{ $orderItem->product_name }}</span>
                                    <span class="text-gray-600">x{{ $orderItem->quantity }}</span>
                                    <span
                                        class="font-semibold text-gray-900">Rp{{ number_format($orderItem->total_price, 3) }}</span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-red-500">No items found in this order.</p>
                        @endif
                    </ul>
                </div>

                <!-- Order Total -->
                <div class="mt-6">
                    <div class="flex justify-between items-center font-semibold">
                        <span class="text-gray-900">Total:</span>
                        <span
                            class="text-gray-900">Rp{{ number_format($orderItems->sum(fn($item) => $item->quantity * $item->total_price), 3) }}</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mb-4 mt-4">
                <div class="ml-6">
                    <a class="inline-block bg-orange-600 text-white py-2 px-4 rounded-lg hover:bg-orange-700 transition"
                        href="{{ route('payments.create', ['orderId' => $customers->id]) }}">Pay Now</a>
                </div>
                <!-- Button to review create page -->
                @if($product) <!-- Pastikan produk ada sebelum tombol tampil -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('reviews.create', $product->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold">
                            Add Review
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
