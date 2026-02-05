<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Item Details</span>
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('items.edit', $item->id) }}" class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-2.5 px-5 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2 hover:scale-105 transition-transform duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit Item</span>
                </a>
                <a href="{{ route('items.index') }}" class="text-gray-700 hover:bg-gray-100 text-gray-700 font-bold py-2.5 px-5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center space-x-2 hover:scale-105 transition-transform duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Content Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-2 border-pink-100">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                        <!-- Left Column - Image Section -->
                        <div class="space-y-4">
                            <div class="relative group">
                                @if($item->image)
                                    <div class="aspect-square rounded-2xl overflow-hidden shadow-2xl border-4 border-pink-100 group-hover:border-pink-200 transition-all duration-300">
                                        <img src="{{ asset('storage/' . $item->image) }}" 
                                             alt="{{ $item->name }}" 
                                             id="main-image"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-square bg-gradient-to-br from-pink-100 via-blue-50 to-pink-50 rounded-2xl flex items-center justify-center shadow-2xl border-4 border-pink-100">
                                        <div class="text-center">
                                            <svg class="w-32 h-32 text-pink-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-pink-400 font-semibold">No Image Available</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Additional Photos Gallery -->
                            @if($item->photos && $item->photos->count() > 0)
                                <div>
                                    <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Gallery ({{ $item->photos->count() }} {{ $item->photos->count() == 1 ? 'photo' : 'photos' }})
                                    </h3>
                                    <div class="grid grid-cols-4 gap-2">
                                        @foreach($item->photos as $photo)
                                            <div class="relative group cursor-pointer" onclick="changeMainImage('{{ asset('storage/' . $photo->photo_path) }}')">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                                                     alt="Product photo"
                                                     class="w-full h-20 object-cover rounded-lg border-2 border-pink-100 hover:border-pink-400 transition-all duration-200 hover:shadow-lg">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-200"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column - Details Section -->
                        <div class="flex flex-col space-y-6">
                            <!-- Item Name & SKU Header -->
                            <div class="pb-6 border-b-2 border-pink-100">
                                <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-500 via-blue-500 to-pink-500 bg-clip-text text-transparent mb-3">
                                    {{ $item->name }}
                                </h1>
                                @if($item->co_name)
                                    <p class="text-lg text-gray-600 font-semibold mb-3">{{ $item->co_name }}</p>
                                @endif
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 border border-gray-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        SKU: {{ $item->SKU }}
                                    </span>
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold {{ $item->availability == 'in stock' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
                                        {{ ucwords($item->availability ?? 'in stock') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Information Grid -->
                            <div class="flex-1 space-y-4">
                                <!-- Type & Category Row -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-l-4 border-pink-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-pink-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Type</p>
                                        </div>
                                        <p class="text-lg font-bold text-pink-600 break-words">{{ $item->type?->name ?? 'NULL' }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-5 border-l-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Category</p>
                                        </div>
                                        <p class="text-lg font-bold text-blue-600 break-words">{{ $item->category?->name ?? 'NULL' }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-l-4 border-pink-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-pink-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Color</p>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800 break-words">{{ $item->color?->name ?? 'NULL' }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-5 border-l-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Material</p>
                                        </div>
                                        <p class="text-lg font-bold text-gray-800 break-words">{{ $item->material?->name ?? 'NULL' }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-5 border-l-4 border-pink-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-pink-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Classification</p>
                                        </div>
                                        <p class="text-lg font-bold text-pink-600 break-words">{{ $item->classification?->name ?? 'NULL' }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-5 border-l-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Size</p>
                                        </div>
                                        <p class="text-lg font-bold text-blue-600 break-words">{{ $item->size?->name ?? 'NULL' }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-5 border-l-4 border-pink-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-pink-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-pink-600 uppercase tracking-wider">Price</p>
                                        </div>
                                        <p class="text-2xl font-bold text-pink-700">Rs {{ number_format($item->prize, 2) }}</p>
                                    </div>

                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 border-l-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Stock</p>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-2xl font-bold {{ $item->stock_items > 10 ? 'text-green-700' : 'text-red-700' }}">
                                                {{ $item->stock_items }}
                                            </span>
                                            <span class="ml-2 text-sm font-medium text-gray-600">units</span>
                                        </div>
                                    </div>

                                    <!-- Installment Options -->
                                    <div class="col-span-1 sm:col-span-2 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 rounded-xl p-5 border-2 border-purple-200 shadow-md">
                                        <div class="flex items-center mb-3">
                                            <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <p class="text-sm font-bold text-purple-700 uppercase tracking-wider">Installment Plans</p>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="bg-white rounded-lg p-3 border border-pink-300 shadow-sm">
                                                <p class="text-xs text-gray-500 mb-1">3 Months</p>
                                                <p class="text-xl font-bold text-pink-600">Rs {{ number_format($item->prize / 3, 2) }}</p>
                                                <p class="text-xs text-gray-400">per month</p>
                                            </div>
                                            <div class="bg-white rounded-lg p-3 border border-blue-300 shadow-sm">
                                                <p class="text-xs text-gray-500 mb-1">4 Months</p>
                                                <p class="text-xl font-bold text-blue-600">Rs {{ number_format($item->prize / 4, 2) }}</p>
                                                <p class="text-xs text-gray-400">per month</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description and Notes Section -->
            @if($item->description || $item->note)
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border-2 border-pink-100">
                @if($item->description)
                <div class="mb-6 pb-6 {{ $item->note ? 'border-b border-pink-100' : '' }}">
                    <h3 class="text-lg font-bold text-pink-600 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Description
                    </h3>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $item->description }}</p>
                </div>
                @endif

                @if($item->note)
                <div>
                    <h3 class="text-lg font-bold text-blue-600 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Note
                    </h3>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $item->note }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Additional Info Section -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-pink-100 hover:border-pink-200 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Value</p>
                            <p class="text-2xl font-bold text-pink-600">Rs {{ number_format($item->prize * $item->stock_items, 2) }}</p>
                        </div>
                        <div class="bg-pink-100 rounded-full p-3 flex-shrink-0">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-blue-100 hover:border-blue-200 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Stock Status</p>
                            <p class="text-lg font-bold {{ $item->stock_items > 10 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $item->stock_items > 10 ? 'Well Stocked' : 'Needs Restock' }}
                            </p>
                        </div>
                        <div class="rounded-full p-3 flex-shrink-0 {{ $item->stock_items > 10 ? 'bg-green-100' : 'bg-red-100' }}">
                            <svg class="w-8 h-8 {{ $item->stock_items > 10 ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeMainImage(imageUrl) {
            const mainImage = document.getElementById('main-image');
            if (mainImage) {
                mainImage.src = imageUrl;
            }
        }
    </script>
</x-app-layout>