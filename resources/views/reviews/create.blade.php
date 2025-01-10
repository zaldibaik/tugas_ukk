<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-white">
            Add Review for {{ $product->product_name }}
        </h2>
    </x-slot>

    <div class=" m-8 bg-white shadow-md rounded-lg p-6">
        <!-- Form for Adding Review -->
        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="space-y-4">
            @csrf

            <!-- Rating -->
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select id="rating" name="rating" required 
                        class="w-full mt-1 p-2 border rounded-md focus:ring-blue-300 focus:border-blue-300">
                    <option value="">Select Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comment -->
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea id="comment" name="comment" rows="4" required
                          class="w-full mt-1 p-2 border rounded-md focus:ring-blue-300 focus:border-blue-300"
                          placeholder="Write your review here...">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
