<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Order Details</h1>
        </div>
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
                            <span class="text-gray-600">{{ $order->id }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Name:</span>
                            <span class="text-gray-600">{{ $order->name }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Phone:</span>
                            <span class="text-gray-600">{{ $order->phone }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">City:</span>
                            <span class="text-gray-600">{{ $order->address1 }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Address:</span>
                            <span class="text-gray-600">{{ $order->address2 }}, {{ $order->address3 }}</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-900">Payment Method:</span>
                            <span class="text-gray-600">{{ ucfirst($order->payment_method) }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Order Items -->
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Items in Your Order</h3>
                    <ul class="space-y-3">
                        @if($order->orderItems && $order->orderItems->isNotEmpty())
                            @foreach($order->orderItems as $orderItem)
                                <li class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">{{ $orderItem->product->name }}</span>
                                    <span class="text-gray-600">x{{ $orderItem->quantity }}</span>
                                    <span class="font-semibold text-gray-900">Rp{{ number_format($orderItem->price, 3) }}</span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-red-500">No it ems found in this order.</p>
                        @endif
                    </ul>
                </div>

                <!-- Order Total -->
                <div class="mt-6">
                    <div class="flex justify-between items-center font-semibold">
                        <span class="text-gray-900">Total:</span>
                        <!-- Pengecekan untuk memastikan total_amount ada -->
                        <span
                            class="text-gray-900">Rp{{ number_format($order->orderItems->sum(fn($item) => $item->quantity * $item->price), 3) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


