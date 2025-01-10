<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Edit User</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium">Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 mt-2 border border-gray-300 rounded-md" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 mt-2 border border-gray-300 rounded-md" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-medium">Password (leave blank if you don't want to change)</label>
                <input type="password" id="password" name="password" class="w-full p-3 mt-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-medium">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 mt-2 border border-gray-300 rounded-md">
            </div>

            <div class="mt-4">
                <button type="submit" class="w-full bg-orange-900 text-white py-2 rounded-md hover:bg-orange-800 transition duration-300">Update User</button>
            </div>
        </form> 
    </div>
</x-app-layout>
