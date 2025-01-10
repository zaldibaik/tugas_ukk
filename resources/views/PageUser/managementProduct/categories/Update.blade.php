<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Update Category</h1>
    </x-slot>

    <div class="container mx-auto p-6 bg-gray-800 rounded-md shadow-md">
        <!-- Form untuk mengedit kategori -->
        <form action="{{ route('ccategorydiscounts.update', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="category_name" class="block text-gray-300 text-lg font-medium">Category Name:</label>
                <input 
                    type="text" 
                    name="category_name" 
                    value="{{ old('category_name', $category->category_name) }}" 
                    class="w-full mt-1 p-2 border border-gray-100 rounded-md bg-gray-100 text-grey-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                >
            </div>

            <button 
                type="submit" 
                class="bg-gray-700 hover:bg-gray-300 text-white font-bold py-2 px-4 rounded"
            >
                Update Category
            </button>
        </form>

        <!-- Tombol kembali ke daftar kategori -->
         <button class="mt-6">
        <a 
            href="{{ route('categorydiscounts.index') }}" 
            class="bg-gray-700 hover:bg-gray-300 text-white font-bold py-2 px-4 rounded "
        >
            Back to Categories
        </a>
</button>
    </div>
</x-app-layout>
