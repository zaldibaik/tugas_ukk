<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Edit Delivery</h1>

        <form action="{{ route('deliveries.update', $delivery->id) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Order ID</label>
                <input type="text" name="order_id" value="{{ $delivery->order_id }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Shipping Date</label>
                <input type="datetime-local" name="shipping_date" value="{{ $delivery->shipping_date }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Tracking Code</label>
                <input type="text" name="tracking_code" value="{{ $delivery->tracking_code }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-500" maxlength="20" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Status</label>
                <input type="text" name="status" value="{{ $delivery->status }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-500" maxlength="20" required>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none">
                    Update
                </button>
                <a href="{{ route('deliveries.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow hover:bg-gray-700 focus:outline-none">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
