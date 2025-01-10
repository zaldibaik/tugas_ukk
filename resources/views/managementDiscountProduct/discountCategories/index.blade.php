<!-- Table Section: List Categories -->
<x-app-layout>
    <div class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full bg-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Category Name</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through categories dynamically -->
                @foreach($discountCategories as $category)
                    <tr class="border-t border-gray-300">
                        <td class="py-3 px-6 text-left">{{ $category->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $category->category_name }}</td>
                        <td class="py-3 px-6 text-center">
                            <!-- Edit Form -->
                            <form method="POST" action="{{ route('discountCategories.update', $category->id) }}"
                                class="inline-block">
                                @csrf
                                @method('PUT')
                                <input type="text" name="category_name" value="{{ $category->category_name }}"
                                    class="border p-1 rounded">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('discountCategories.destroy', $category->id) }}" method="POST"
                                class="inline-block ml-2"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori diskon ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-md">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>