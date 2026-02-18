<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">User Management</span>
            </h2>
            <a href="{{ route('users.create') }}" class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2 hover:scale-105 transition-transform duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Add New User</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-2 border-pink-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-pink-100" aria-label="Items list">
                        <thead class="bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50">
                            <tr>
                                <th class="px-6 py-4 text-center text-xs font-bold text-pink-700 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-pink-700 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-pink-700 uppercase tracking-wider">Created At</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-pink-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-pink-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-colors duration-150">
                                    <!-- ✅ FIXED: Removed flex wrapper, now matches other columns -->
                                    <td class="px-6 py-5 text-center text-sm text-gray-900">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm text-gray-900">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm text-gray-900">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="inline-flex items-center gap-1.5
                                                      px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg
                                                      border border-amber-200
                                                      hover:bg-amber-200 hover:border-amber-500
                                                      transition-all duration-200
                                                      hover:shadow-md hover:-translate-y-0.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-1.5 bg-red-50 text-red-700 rounded-lg
                                                           border border-red-200
                                                           hover:bg-red-200 hover:border-red-500
                                                           transition-all duration-200
                                                           hover:shadow-md hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>