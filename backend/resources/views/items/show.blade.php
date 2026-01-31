<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Item Details</span>
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('items.edit', $item->id) }}" class="bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit Item</span>
                </a>
                <a href="{{ route('items.index') }}" class="bg-white border-2 border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-2 border-pink-100">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Image Section -->
                        <div class="flex flex-col items-center justify-center">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-96 object-cover rounded-lg shadow-lg border-2 border-pink-100">
                            @else
                                <div class="w-full h-96 bg-gradient-to-br from-pink-100 to-blue-100 rounded-lg flex items-center justify-center shadow-lg border-2 border-pink-100">
                                    <svg class="w-32 h-32 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details Section -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent">
                                    {{ $item->name }}
                                </h3>
                            </div>

                            <div class="space-y-4">
                                <div class="border-l-4 border-pink-400 pl-4 py-2">
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">SKU</p>
                                    <p class="text-lg text-gray-900 font-medium">{{ $item->SKU }}</p>
                                </div>

                                <div class="border-l-4 border-blue-400 pl-4 py-2">
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Type</p>
                                    <p class="text-lg text-pink-600 font-semibold">{{ $item->type?->name ?? 'N/A' }}</p>
                                </div>

                                <div class="border-l-4 border-pink-400 pl-4 py-2">
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Category</p>
                                    <p class="text-lg text-gray-900 font-medium">{{ $item->category }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="border-l-4 border-blue-400 pl-4 py-2">
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Color</p>
                                        <p class="text-lg text-gray-900 font-medium">{{ $item->color }}</p>
                                    </div>

                                    <div class="border-l-4 border-pink-400 pl-4 py-2">
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Material</p>
                                        <p class="text-lg text-gray-900 font-medium">{{ $item->material }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="border-l-4 border-blue-400 pl-4 py-2">
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Price</p>
                                        <p class="text-2xl font-bold text-gray-900">Rs {{ number_format($item->prize, 2) }}</p>
                                    </div>

                                    <div class="border-l-4 border-pink-400 pl-4 py-2">
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Stock</p>
                                        <span class="inline-flex items-center px-4 py-2 text-lg font-semibold rounded-full {{ $item->stock_items > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $item->stock_items }} units
                                        </span>
                                    </div>
                                </div>

                                <div class="border-l-4 border-blue-400 pl-4 py-2">
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Created</p>
                                    <p class="text-lg text-gray-900">{{ $item->created_at->format('F d, Y \a\t h:i A') }}</p>
                                </div>

                                @if($item->updated_at != $item->created_at)
                                    <div class="border-l-4 border-pink-400 pl-4 py-2">
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Last Updated</p>
                                        <p class="text-lg text-gray-900">{{ $item->updated_at->format('F d, Y \a\t h:i A') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-pink-100 flex justify-end space-x-3">
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span>Delete Item</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
