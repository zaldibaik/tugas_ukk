<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl text-white font-semibold">Manage Categories</h1>
    </x-slot>

    <!-- Form Section: Add this above the table -->
    <div class="container mx-auto p-4">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-900">Category Name:</label>
                <input type="text" name="category_name" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <button type="submit" class="bg-orange-700 text-white px-2 py-1 rounded mb-4 inline-block">Save</button>
        </form>
        
        <!-- Kembali Button -->
        <a href="{{ route('discountCategories.create') }}" class="bg-orange-700 text-white px-4 py-2 rounded-md inline-block mt-4">Close Category</a>
    </div>

    <!-- Table Section: Move this below the form -->
    <div class="overflow-x-auto rounded-lg p-5 rounded-lg">
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
                @foreach($categories as $category)
                    <tr class="border-t border-gray-300">
                        <td class="py-3 px-6 text-left">{{ $category->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $category->category_name }}</td>
                        <td class="py-3 px-6 text-center">
                            <!-- Edit Button -->
                            <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md inline-block">Edit</a>
                            <!-- Delete Button -->
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
