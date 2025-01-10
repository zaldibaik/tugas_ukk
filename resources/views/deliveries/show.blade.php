<x-app-layout>
    <div class="container mx-auto py-8">
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Deliveries Details</h1>
    </x-slot>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-grey">Order ID:</h2>
                <p class="text-gray-600 dark:text-gray-800">{{ $delivery->order_id }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold text-grey">Shipping Date:</h2>
                <p class="text-gray-600 dark:text-gray-800">{{ $delivery->shipping_date }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold text-grey">Tracking Code:</h2>
                <p class="text-gray-600 dark:text-gray-800">{{ $delivery->tracking_code }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold text-grey">Status:</h2>
                <p class="text-gray-600 dark:text-gray-800">{{ $delivery->status }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('deliveries.edit', $delivery->id) }}" class="px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg shadow hover:bg-yellow-700 focus:outline-none">
                    Edit
                </a>
                <form action="{{ route('deliveries.destroy', $delivery->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this delivery?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ml-2 px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none">
                        Delete
                    </button>
                </form>
                <a href="{{ route('deliveries.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow hover:bg-gray-700 focus:outline-none">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
