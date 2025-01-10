<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Management Products</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-500 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Orders Table -->
        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full bg-gray-100 shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-300 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Products ID</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Product Name</th>
                        <th class="py-3 px-4 text-left">Phone</th>

                        <th class="py-3 px-4 text-right">Total Price</th>
                        <th class="py-3 px-4 text-left">Created At</th>
                        <th class="py-3 px-4 text-left">Updated At</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse ($orders as $order)
                        @foreach ($order->orderItems as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $order->id }}</td>
                                <td class="py-3 px-4">{{ $item->products_id }}</td>
                                <td class="py-3 px-4">{{ $item->quantity }}</td>
                                <td class="py-3 px-4">{{ $item->product_name }}</td>
                                <td class="py-3 px-4">{{ $item->phone }}</td>
                                <td class="py-3 px-4 text-right">Rp {{ number_format($item->total_price, 3, ',', '.') }}</td>
                                <td class="py-3 px-4">{{ $order->created_at }}</td>
                                <td class="py-3 px-4">{{ $order->updated_at }}</td>
                                <td class="py-3 px-4 text-center">
                                    <!-- Actions -->
                                    <div class="flex space-x-2 justify-center">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('managementOrder.edit', $order->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                            Edit
                                        </a>

                                        <!-- Tombol View -->
                                        <a href="{{ route('managementOrder.show', $order->id) }}"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                            View
                                        </a>

                                        <!-- Tombol Delete -->
                                        <form action="{{ route('managementOrder.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">
                                No orders available.
                            </td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>

    <!-- Flowbite Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.1/dist/flowbite.js"></script>
</x-app-layout>