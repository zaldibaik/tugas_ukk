<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto py-8">
            <h1 class="text-gray-200 text-2xl font-semibold">Management Users</h1>
        </div>
    </x-slot>

    <div class="mt-4 p-4 rounded-lg">
        <a href="{{ route('users.create') }}" class="bg-orange-900 text-white px-2 py-1 rounded mb-4 inline-block">Add New User</a>

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
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $user->id }}</td>
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">{{ $user->created_at }}</td>
                            <td class="py-1 px-3 text-center">
                                <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 rounded-lg px-5 py-2 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2 mb-2 bg-red-500 rounded-lg px-4 py-1.5 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
