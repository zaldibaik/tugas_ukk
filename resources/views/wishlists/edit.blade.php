<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Edit Wishlist</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">
        <form action="{{ route('wishlists.update', $wishlist) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="dorder_id" class="block text-sm font-medium text-gray-700">dorder</label>
                <select name="dorder_id" id="dorder_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @foreach ($orders as $dorder)
                        <option value="{{ $dorder->id }}" {{ $dorder->id == $wishlist->dorder_id ? 'selected' : '' }}>{{ $dorder->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                <select name="product_id" id="product_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $wishlist->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:underline">Update Wishlist</button>
        </form>
    </div>
</x-app-layout>
