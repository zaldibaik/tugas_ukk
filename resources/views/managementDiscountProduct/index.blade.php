<!-- resources/views/managementDiscountProduct/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Discount Management</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('discounts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Discount</a>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full bg-gray-100 rounded-lg">
                <thead>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <th class="p-4">ID</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Product</th>
                        <th class="p-4">Start Date</th>
                        <th class="p-4">End Date</th>
                        <th class="p-4">Percentage</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discounts as $discount)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="p-4">{{ $discount->id }}</td>
                            <td class="p-4">{{ $discount->category_discount_id }}</td>
                            <td class="p-4">{{ $discount->product_id }}</td>
                            <td class="p-4">{{ $discount->start_date }}</td>
                            <td class="p-4">{{ $discount->end_date }}</td>
                            <td class="p-4">{{ $discount->percentage }}%</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('discounts.edit', $discount) }}" class="bg-blue-600 text-gray-100 hover:underline rounded-lg py-1.5 px-3">Edit</a>
                                <form action="{{ route('discounts.destroy', $discount) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-gray-100 hover:underline rounded-lg py-1.5 px-3">Delete</button>
                                </form>
                                <a href="{{ route('discounts.show', $discount) }}" class="text-blue-500 ml-2">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
