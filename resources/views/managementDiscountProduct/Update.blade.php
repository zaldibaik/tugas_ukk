<!-- resources/views/managementDiscountProduct/edit.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Edit Discount</h1>

        <form action="{{ route('discounts.update', $discount) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block">Category:</label>
                <input type="number" name="category_discount_id" class="border p-2 w-full" value="{{ $discount->category_discount_id }}" required>
            </div>
            
            <div class="mb-4">
                <label class="block">Product:</label>
                <input type="number" name="product_id" class="border p-2 w-full" value="{{ $discount->product_id }}" required>
            </div>

            <div class="mb-4">
                <label class="block">Start Date:</label>
                <input type="date" name="start_date" class="border p-2 w-full" value="{{ $discount->start_date }}" required>
            </div>

            <div class="mb-4">
                <label class="block">End Date:</label>
                <input type="date" name="end_date" class="border p-2 w-full" value="{{ $discount->end_date }}" required>
            </div>

            <div class="mb-4">
                <label class="block">Discount Percentage:</label>
                <input type="number" name="percentage" class="border p-2 w-full" value="{{ $discount->percentage }}" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
