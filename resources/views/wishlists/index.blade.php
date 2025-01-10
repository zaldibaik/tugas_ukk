<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Wishlist Management</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">

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
                        <th class="py-3 px-6 text-left">Customer</th>
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($wishlists as $wishlist)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $wishlist->id }}</td>
                            <!-- Pastikan relasi antara wishlist dan user/customer sudah benar -->
                            <td class="py-3 px-6">{{ $wishlist->user->name }}</td>
                            <!-- Menampilkan nama produk, bukan ID produk -->
                            <td class="py-3 px-6">{{ $wishlist->product->name }}</td>
                            <td class="py-1 px-3 text-center">
                                <!-- Tombol untuk melihat detail wishlist -->
                                <a href="{{ route('wishlists.show', $wishlist) }}" class="bg-blue-500 text-white rounded-lg px-5 py-2 hover:underline">View</a>
                                <!-- Tombol untuk mengedit wishlist -->
                                <a href="{{ route('wishlists.edit', $wishlist) }}" class="bg-yellow-500 text-white rounded-lg px-5 py-2 hover:underline">Edit</a>
                                <!-- Form untuk menghapus wishlist dengan konfirmasi -->
                                <form action="{{ route('wishlists.destroy', $wishlist) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this wishlist?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2 mb-2 bg-red-500 text-white rounded-lg px-4 py-1.5 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
