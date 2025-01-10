<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Payment</h1>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-8">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <!-- Order ID -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Order ID</label>
                    <div class="p-3 mt-2 bg-gray-100 border border-gray-300 rounded-md">
                        {{ $order->id }}
                    </div>
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                </div>

                <!-- Total Amount -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Total Amount</label>
                    <div class="p-3 mt-2 bg-gray-100 border border-gray-300 rounded-md">
                        Rp{{ number_format($order->total_amount, 3) }}
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-6">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <input type="text" id="payment_method" name="payment_method"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md @error('payment_method') border-red-500 @enderror"
                        value="{{ old('payment_method') }}" placeholder="e.g., Bank Transfer" required>
                    @error('payment_method')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount', $order->total_amount) }}"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md @error('amount') border-red-500 @enderror"
                        required>
                    @error('amount')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address Dropdown -->
                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                    <select id="address" name="address" 
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md @error('address') border-red-500 @enderror" required>
                        <option value="" disabled selected>Select Address</option>
                        @foreach($customer->addresses as $address)
                            <option value="{{ $address }}" 
                                {{ old('address') == $address ? 'selected' : '' }}>
                                {{ $address }}
                            </option>
                        @endforeach
                    </select>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit"
                        class="w-full py-3 px-6 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition">
                        Pay Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
