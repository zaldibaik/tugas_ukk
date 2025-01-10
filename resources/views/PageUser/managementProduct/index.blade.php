<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Management Products</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">
        <a href="{{ route('products.create') }}" class="bg-orange-900 text-white px-2 py-1 rounded mb-4 inline-block">Add New Product</a>

        <!-- Pesan sukses jika ada -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full bg-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Stock</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($products as $product)    
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $product->id }}</td>
                            <td class="py-3 px-6">{{ optional($product->category)->category_name ?? 'No Category' }}</td>
                            <td class="py-3 px-6">{{ $product->product_name }}</td>
                            <td class="py-3 px-6">{{Str::limit ($product->description,50) }}</td>
                            <td class="py-3 px-6">Rp {{ number_format($product->price, 3, ',', '.') }}</td>
                            <td class="py-3 px-6">{{ $product->stok_quantity }}</td>
                            <td class="py-3 px-6">{{ $product->created_at }}</td>
                            <td class="py-1 px-1 grid grid-cols-2 gap-1">
                                <img src="{{ asset('storage/' . $product->image1_url) }}" alt="{{ $product->product_name }}" class="w-8 h-8 object-cover rounded">
                                <img src="{{ asset('storage/' . $product->image2_url) }}" alt="{{ $product->product_name }}" class="w-8 h-8 object-cover rounded">
                                <img src="{{ asset('storage/' . $product->image3_url) }}" alt="{{ $product->product_name }}" class="w-8 h-8 object-cover rounded">
                                <img src="{{ asset('storage/' . $product->image4_url) }}" alt="{{ $product->product_name }}" class="w-8 h-8 object-cover rounded">
                                <img src="{{ asset('storage/' . $product->image5_url) }}" alt="{{ $product->product_name }}" class="w-8 h-8 object-cover rounded">
                            </td>
                            <td class="py-1 px-3 text-center">
                                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 rounded-lg px-5 py-2 hover:underline">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2 mb-2 bg-red-500 rounded-lg px-4 py-1.5 hover:underline">Delete</button>
                                </form>
                                <a href="{{ route('products.edit', $product) }}" class="bg-green-500 rounded-lg px-5 py-2 hover:underline">Info</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.1/dist/flowbite.js"></script>
    </div>
</x-app-layout>
