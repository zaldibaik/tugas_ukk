<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Edit Payment</h1>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Payment</h2>

            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="order_id" class="block text-sm font-medium text-gray-700">Order ID</label>
                    <input type="text" id="order_id" name="order_id" class="w-full p-3 mt-2 border border-gray-300 rounded-md" value="{{ old('order_id', $payment->order_id) }}" required>
                </div>

                <div class="mb-4">
                    <label for="payment_date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                    <input type="datetime-local" id="payment_date" name="payment_date" class="w-full p-3 mt-2 border border-gray-300 rounded-md" value="{{ old('payment_date', $payment->payment_date) }}" required>
                </div>

                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <input type="text" id="payment_method" name="payment_method" class="w-full p-3 mt-2 border border-gray-300 rounded-md" value="{{ old('payment_method', $payment->payment_method) }}" required>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" id="amount" name="amount" class="w-full p-3 mt-2 border border-gray-300 rounded-md" value="{{ old('amount', $payment->amount) }}" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">Update Payment</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
