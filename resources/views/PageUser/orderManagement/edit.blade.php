<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Update Order</h1>
        </div>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Update Order Details</h2>

            <form action="{{ route('managementOrder.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <!-- Order Details -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Order Details</h3>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="name">Name:</label>
                            <input type="text" id="name" name="name"
                                   value="{{ $order->name }}"
                                   class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone"
                                   value="{{ $order->phone }}"
                                   class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="address1">City:</label>
                            <input type="text" id="address1" name="address1"
                                   value="{{ $order->address1 }}"
                                   class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="address2">Address Line 1:</label>
                            <input type="text" id="address2" name="address2"
                                   value="{{ $order->address2 }}"
                                   class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="address3">Address Line 2:</label>
                            <input type="text" id="address3" name="address3"
                                   value="{{ $order->address3 }}"
                                   class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="payment_method">Payment Method:</label>
                            <select id="payment_method" name="payment_method"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="cash" {{ $order->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="credit_card" {{ $order->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>COD</option>

                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                                class="w-full bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600">
                            Update Order
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
