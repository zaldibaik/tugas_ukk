<!-- resources/views/managementDiscountProduct/create.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Create Discount</h1>

        <form action="{{ route('discounts.store') }}" method="POST">
            @csrf

            <!-- Category Selection -->
            <div class="mb-4">
                <label class="block">Category:</label>
                <select name="category_discount_id" class="w-full border border-gray-900 p-2 rounded" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($discountCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('category_discount_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Product Selection -->
            <div class="mb-4">
                <label class="block">Product:</label>
                <select name="product_id" class="w-full border border-gray-900 p-2 rounded" required>
                    <option value="" disabled selected>Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-4">
                <label class="block">Start Date:</label>
                <input type="date" name="start_date" class="w-full border border-gray-900 p-2 rounded" required>
                @error('start_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label class="block">End Date:</label>
                <input type="date" name="end_date" class="w-full border border-gray-900 p-2 rounded" required>
                @error('end_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Discount Percentage -->
            <div class="mb-4">
                <label class="block">Discount Percentage:</label>
                <input type="number" name="percentage" class="w-full border border-gray-900 p-2 rounded" required min="1" max="100" placeholder="1 - 100">
                @error('percentage')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</x-app-layout>
