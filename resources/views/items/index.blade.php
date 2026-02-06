<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Items Management</span>
            </h2>
            <a href="{{ route('items.create') }}" class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2 hover:scale-105 transition-transform duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Add New Item</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-md relative mb-6 flex items-center" role="alert">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-2 border-pink-100">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-pink-100">
                            <thead class="bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50">
                                <tr>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-pink-700 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-blue-700 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-pink-700 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-blue-700 uppercase tracking-wider">Color</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Availability</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-blue-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-pink-50">
                                @forelse($items as $item)
                                    <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-gray-900">{{ $item->name }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-pink-600 font-medium">
                                                {{ $item->type?->name ?? 'NULL' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-blue-600 font-medium">
                                                {{ $item->category?->name ?? 'NULL' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600">{{ $item->color?->name ?? 'NULL' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-bold text-gray-900">Rs {{ number_format($item->prize, 2) }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->stock_items > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $item->stock_items }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ ($item->availability ?? 'in stock') == 'in stock' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucwords($item->availability ?? 'in stock') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">

                                            <a href="{{ route('items.edit', $item->id) }}"
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
                                                
                                                <a href="{{ route('items.show', $item->id) }}"
                                                   class="inline-flex items-center gap-1.5
                                                          px-3 py-1.5 bg-green-50 text-green-700 rounded-lg
                                                          border border-green-200
                                                          hover:bg-green-200 hover:border-green-500
                                                          transition-all duration-200
                                                          hover:shadow-md hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    <span>View</span>
                                                </a>

                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-3">
                                                <svg class="w-16 h-16 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                <p class="text-gray-500 text-lg font-medium">No items found</p>
                                                <a href="{{ route('items.create') }}" class="bg-gradient-to-r from-pink-400 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                                    Create your first item
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-t border-pink-100">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                Showing <span class="font-semibold text-pink-600">{{ $items->firstItem() ?? 0 }}</span> to <span class="font-semibold text-pink-600">{{ $items->lastItem() ?? 0 }}</span> of <span class="font-semibold text-blue-600">{{ $items->total() }}</span> results
                            </div>
                            <div class="flex space-x-1">
                                @if ($items->onFirstPage())
                                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                                @else
                                    <a href="{{ $items->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">Previous</a>
                                @endif

                                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                                    @if ($page == $items->currentPage())
                                        <span class="px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-pink-500 to-blue-500 border border-pink-500 rounded-lg shadow-md">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($items->hasMorePages())
                                    <a href="{{ $items->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-blue-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-blue-300 transition-all duration-200">Next</a>
                                @else
                                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

