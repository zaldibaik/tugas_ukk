<x-app-layout>
    <div class="container md:pb-24 md:pl-24 md:pr-24 pb-10 pl-10 pr-10">
        <h1 class="text-2xl text-white font-semibold pt-8">Update Products</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menambahkan method PUT untuk update data -->
            <div>
                <label class="block text-gray-300 text-xl">Product Name:</label>
                <input type="text" name="product_name" class="w-full border border-gray-300 p-2 rounded" value="{{ old('product_name', $product->product_name) }}" required>
            </div>

            <div>
                <label class="block text-gray-300">Description:</label>
                <textarea name="description" class="w-full border border-gray-300 p-2 rounded" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-300">Price:</label>
                <input type="number" name="price" class="w-full border border-gray-300 p-2 rounded" value="{{ old('price', $product->price) }}" required>
            </div>

            <div>
                <label class="block text-gray-300">Stock Quantity:</label>
                <input type="number" name="stok_quantity" class="w-full border border-gray-300 p-2 rounded" value="{{ old('stok_quantity', $product->stok_quantity) }}" required>
            </div>

            <div>
                <label class="block text-gray-300">Category:</label>
                <select name="product_category_id" class="w-full border border-gray-300 p-2 rounded" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->product_category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input untuk gambar dengan preview -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach(range(1, 5) as $index)
                    <div>
                        <label class="block text-gray-300">Product Image {{ $index }}:</label>
                        @if($product->{'image' . $index . '_url'})
                            <img id="preview{{ $index }}" src="{{ asset('storage/images/' . $product->{'image' . $index . '_url'}) }}" class="mt-2 max-h-40 w-full object-cover">
                        @else
                            <img id="preview{{ $index }}" class="mt-2 max-h-40 w-full object-cover hidden">
                        @endif
                        <input type="file" name="image{{ $index }}_url" class="w-full border border-gray-300 p-2 rounded" onchange="previewImage(event, 'preview{{ $index }}')">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-gray-700 hover:bg-gray-300 text-white font-bold py-2 px-4 rounded">Save Changes</button>
        </form>
    </div>

    <script>
        function previewImage(event, previewId) {
            const image = document.getElementById(previewId);
            image.src = URL.createObjectURL(event.target.files[0]);
            image.classList.remove('hidden');
        }
    </script>
</x-app-layout>
