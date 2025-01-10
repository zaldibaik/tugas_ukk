<x-app-layout>
    <div class="container md:pb-24 md:pl-24 md:pr-24 pb-10 pl-10 pr-10">
        <h1 class="text-2xl text-gray font-semibold pt-8">Create New Product</h1>
        
        <!-- Display errors if validation fails -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf  
            <div>
                <label class="block text-gray-900 text-xl">Product Name:</label>
                <input type="text" name="product_name" class="w-full border border-gray-900 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-gray-900">Description:</label>
                <textarea name="description" class="w-full border border-gray-900 p-2 rounded" required></textarea>
            </div>

            <div>
                <label class="block text-gray-900">Price:</label>
                <input type="number" name="price" class="w-full border border-gray-900 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-gray-900">Stock Quantity:</label>
                <input type="number" name="stok_quantity" class="w-full border border-gray-900 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-gray-900">Category:</label>
                <select name="product_category_id" class="w-full border border-gray-900 p-2 rounded" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input for images with preview functionality -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <div>
                        <label class="block text-gray-900">Product Image {{ $i }}:</label>
                        <img id="preview{{ $i }}" class="mt-2 max-h-40 w-full object-cover hidden">
                        <input type="file" name="image{{ $i }}_url" class="w-full border border-gray-900 p-2 rounded" onchange="previewImage(event, 'preview{{ $i }}')">
                    </div>
                @endfor
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-orange-900 text-white font-bold py-2 px-4 rounded">Save</button>
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
