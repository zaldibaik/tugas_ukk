<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h2 class="text-xl font-semibold">Tambah Produk ke Wishlist</h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 sm:px-6 lg:px-8">
        <!-- Menampilkan pesan sukses atau error -->
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 border border-green-500 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mt-4 p-4 bg-red-100 border border-red-500 text-red-800 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form untuk menambahkan produk ke wishlist -->
        <form action="{{ route('wishlists.store', $product->id) }}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="product_name" id="product_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->name }}" readonly>
            </div>

            <div class="mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Tambah ke Wishlist
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
