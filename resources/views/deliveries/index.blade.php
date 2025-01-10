<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Deliveries</h1>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Delivery List</h2>

            <a href="{{ route('deliveries.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add New Delivery</a>

            <table class="w-full mt-4">
                <thead>
                    <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                        <th class="border px-4 py-2 text-left">ID</th>
                        <th class="border px-4 py-2 text-left">Order ID</th>
                        <th class="border px-4 py-2 text-left">Shipping Date</th>
                        <th class="border px-4 py-2 text-left">Tracking Code</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $delivery)
                        <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                            <td class="border px-4 py-2">{{ $delivery->id }}</td>
                            <td class="border px-4 py-2">{{ $delivery->order_id }}</td>
                            <td class="border px-4 py-2">{{ $delivery->shipping_date }}</td>
                            <td class="border px-4 py-2">{{ $delivery->tracking_code }}</td>
                            <td class="border px-4 py-2">{{ $delivery->status }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('deliveries.edit', $delivery->id) }}" class="bg-blue-600 text-gray-100 hover:underline rounded-lg py-1.5 px-3">Edit</a>
                                <form action="{{ route('deliveries.destroy', $delivery->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this delivery?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-gray-100 hover:underline rounded-lg py-1.5 px-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
