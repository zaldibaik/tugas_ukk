<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Payments</h1>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment List</h2>
            <div class="overflow-x-auto rounded-lg mt-4">
            <table class="min-w-full bg-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                        <th class="border px-4 py-2 text-left">Order ID</th>
                        <th class="border px-4 py-2 text-left">Payment Date</th>
                        <th class="border px-4 py-2 text-left">Payment Method</th>
                        <th class="border px-4 py-2 text-left">Amount</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach($payments as $payment)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $payment->order_id }}</td>
                            <td class="border px-4 py-2">{{ $payment->payment_date }}</td>
                            <td class="border px-4 py-2">{{ $payment->payment_method }}</td>
                            <td class="border px-4 py-2">${{ number_format($payment->amount) }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('payments.edit', parameters: $payment->id) }}" class="bg-blue-600 rounded-lg py-2 px-3 text-gray-100 hover:underline">Edit</a>
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this payment?')">
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
