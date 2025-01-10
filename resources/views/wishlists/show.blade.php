<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Wishlist Detail</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">
        <div class="mb-4">
            <strong>ID:</strong> {{ $wishlist->id }}
        </div>
        <div class="mb-4">
            <strong>Customer:</strong> {{ $wishlist->order->name }}
        </div>
        <div class="mb-4">
            <strong>Product:</strong> {{ $wishlist->product->name }}
        </div>

        <a href="{{ route('wishlists.index') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg">Back to Wishlist</a>
    </div>
</x-app-layout>
