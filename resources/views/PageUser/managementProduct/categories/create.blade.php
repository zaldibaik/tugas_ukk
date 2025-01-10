<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Create Categorie Product</h1>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Form untuk menambahkan kategori -->
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-900">Category Name:</label>
                <input type="text" name="category_name" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <button type="submit" class="bg-orange-700 text-white px-2 py-1 rounded mb-4 inline-block">Save</button>
        </form>

        <!-- Tombol kembali ke daftar kategori -->
        <a href="{{ route('categories.index') }}" class="bg-orange-700 text-white px-4 py-2 rounded-md inline-block mt-4">Show Category</a>
    </div>
</x-app-layout>
