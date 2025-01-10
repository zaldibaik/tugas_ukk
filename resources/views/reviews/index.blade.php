<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-white">
            {{ $product->product_name }} - Reviews
        </h2>
    </x-slot>

    <div class=" m-8 bg-white shadow-md rounded-lg p-6">
        <!-- Add Review Button -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('reviews.create', $product->id) }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold">
                Add Review
            </a>
        </div>

        <!-- Review List -->
        @forelse ($reviews as $review)
            <div class="border-b border-gray-200 pb-4 mb-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-yellow-500 text-lg">
                        {!! str_repeat('★', $review->rating) !!}
                        {!! str_repeat('☆', 5 - $review->rating) !!}
                    </span>

                    <!-- Tombol Delete -->
                    @if (auth()->id() === $review->customer_id || auth()->user()->is_admin)
                        <!-- Sesuaikan dengan aturan Anda -->
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
                <p class="text-gray-800">{{ $review->comment }}</p>
                <p class="text-sm text-gray-500 mt-2">Reviewed on {{ $review->created_at->format('d M Y') }}</p>
            </div>
        @empty
            <p class="text-gray-600">No reviews yet for this product.</p>
        @endforelse


        <!-- Pagination -->
        <div class="mt-4">
        </div>
    </div>
</x-app-layout>