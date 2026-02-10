<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Item Details</span>
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('items.edit', $item->id) }}" class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-2.5 px-5 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit Item</span>
                </a>
                <a href="{{ route('items.index') }}" class="text-gray-700 hover:bg-gray-100 font-bold py-2.5 px-5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center space-x-2 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column - Basic Information -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Basic Details Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-pink-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Basic Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Name</label>
                                <div class="w-full rounded-lg border-2 border-pink-200 bg-pink-50 px-4 py-3 text-gray-800 font-semibold">
                                    {{ $item->name }}
                                </div>
                            </div>

                            <!-- Co Name -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Co Name</label>
                                <div class="w-full rounded-lg border-2 border-pink-200 bg-pink-50 px-4 py-3 text-gray-800">
                                    {{ $item->co_name ?? 'N/A' }}
                                </div>
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">SKU</label>
                                <div class="w-full rounded-lg border-2 border-pink-200 bg-pink-50 px-4 py-3 text-gray-800 font-mono">
                                    {{ $item->SKU }}
                                </div>
                            </div>

                            <!-- Stock -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Stock Quantity</label>
                                <div class="w-full rounded-lg border-2 border-pink-200 bg-pink-50 px-4 py-3 text-gray-800 font-bold {{ $item->stock_items > 10 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->stock_items }} units
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($item->description)
                        <div class="mt-4">
                            <label class="block font-semibold mb-2 text-gray-700">Description</label>
                            <div class="w-full rounded-lg border-2 border-pink-200 bg-pink-50 px-4 py-3 text-gray-700 whitespace-pre-wrap min-h-[80px]">
                                {{ $item->description }}
                            </div>
                        </div>
                        @endif

                        <!-- Note -->
                        @if($item->note)
                        <div class="mt-4">
                            <label class="block font-semibold mb-2 text-gray-700">Note</label>
                            <div class="w-full rounded-lg border-2 border-pink-200 bg-pink-50 px-4 py-3 text-gray-700 whitespace-pre-wrap min-h-[80px]">
                                {{ $item->note }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Categories & Attributes Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-blue-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            Selections
                        </h3>
                        
                        @php
                            $classificationList = $item->classifications ?? collect();
                            $colorList = $item->colors ?? collect();
                        @endphp
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Category -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Category</label>
                                <div class="w-full rounded-lg border-2 border-blue-200 bg-blue-50 px-4 py-3 text-gray-800 font-semibold">
                                    {{ $item->category?->name ?? 'N/A' }}
                                </div>
                            </div>

                            <!-- Type -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Type</label>
                                <div class="w-full rounded-lg border-2 border-blue-200 bg-blue-50 px-4 py-3 text-gray-800 font-semibold">
                                    {{ $item->type?->name ?? 'N/A' }}
                                </div>
                            </div>

                            <!-- Classification -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Classification</label>
                                <div class="w-full rounded-lg border-2 border-blue-200 bg-blue-50 px-4 py-3">
                                    @if($classificationList->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($classificationList as $classification)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-blue-700">
                                                    {{ $classification->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @elseif($item->classification)
                                        <span class="text-gray-800 font-semibold">{{ $item->classification->name }}</span>
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Color</label>
                                <div class="w-full rounded-lg border-2 border-blue-200 bg-blue-50 px-4 py-3">
                                    @if($colorList->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($colorList as $color)
                                                <span class="inline-flex items-center gap-2 px-2 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-gray-700" title="{{ $color->name }}">
                                                    <span class="w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $color->hex_code ?? '#CCCCCC' }}"></span>
                                                    {{ $color->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @elseif($item->color)
                                        <div class="flex items-center gap-3">
                                            <div class="w-6 h-6 rounded border-2 border-gray-300" style="background-color: {{ $item->color->hex_code ?? '#CCCCCC' }}"></div>
                                            <span class="text-gray-800 font-semibold">{{ $item->color->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Material -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Material</label>
                                <div class="w-full rounded-lg border-2 border-blue-200 bg-blue-50 px-4 py-3 text-gray-800 font-semibold">
                                    {{ $item->material?->name ?? 'N/A' }}
                                </div>
                            </div>

                            <!-- Size -->
                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Size</label>
                                <div class="w-full rounded-lg border-2 border-blue-200 bg-blue-50 px-4 py-3">
                                    @if($item->size)
                                        @if(in_array(strtoupper($item->size->name), ['S', 'M', 'L', 'XL', 'XXL']))
                                            <div class="inline-flex items-center px-6 py-2 rounded-lg border-2 border-pink-500 bg-gradient-to-r from-pink-50 to-blue-50 text-pink-700 font-bold">
                                                {{ $item->size->name }}
                                            </div>
                                        @else
                                            <span class="text-gray-800 font-semibold">{{ $item->size->name }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Images Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-purple-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Product Images
                        </h3>

                        <!-- Main Image -->
                        <div class="mb-6">
                            <label class="block font-semibold mb-3 text-gray-700">Main Image</label>
                            
                            @if($item->image)
                                <div class="relative group">
                                    <img id="main-image" src="{{ Storage::url($item->image) }}?v={{ $item->updated_at?->timestamp ?? time() }}" 
                                         alt="{{ $item->name }}"
                                         onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
                                         class="w-full h-96 object-cover rounded-xl border-4 border-purple-200 shadow-lg group-hover:shadow-2xl transition-all duration-300">
                                </div>
                            @else
                                <div class="flex justify-center px-6 py-16 border-2 border-dashed border-purple-200 rounded-xl bg-purple-50">
                                    <div class="text-center">
                                        <svg class="mx-auto h-16 w-16 text-purple-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-3 text-purple-400 font-semibold">No main image available</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Additional Photos -->
                        @if($item->photos && $item->photos->count() > 0)
                            <div>
                                <div class="flex justify-between items-center mb-3">
                                    <label class="block font-semibold text-gray-700">Additional Photos</label>
                                    <span class="text-xs text-purple-600 bg-purple-100 px-3 py-1 rounded-full font-semibold">{{ $item->photos->count() }} {{ $item->photos->count() == 1 ? 'photo' : 'photos' }}</span>
                                </div>
                                
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @foreach($item->photos as $photo)
                                        <div class="relative group cursor-pointer" onclick="changeMainImage('{{ Storage::url($photo->photo_path) }}?v={{ $item->updated_at?->timestamp ?? time() }}')">
                                            <img src="{{ Storage::url($photo->photo_path) }}?v={{ $item->updated_at?->timestamp ?? time() }}" 
                                                 alt="Product photo"
                                                 onerror="this.classList.add('opacity-50')"
                                                 class="w-full h-32 object-cover rounded-lg border-2 border-purple-200 hover:border-purple-400 transition-all duration-200 hover:shadow-lg hover:scale-105">
                                            <div class="absolute inset-0 bg-gradient-to-t from-purple-900/50 to-transparent opacity-0 group-hover:opacity-100 rounded-lg transition-opacity duration-200 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div>
                                <label class="block font-semibold mb-3 text-gray-700">Additional Photos</label>
                                <div class="bg-purple-50 border-2 border-dashed border-purple-200 rounded-lg p-6 text-center">
                                    <p class="text-purple-400 font-medium">No additional photos available</p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Right Column - Pricing & Stock -->
                <div class="lg:col-span-1 space-y-6">
                    
                    <!-- Pricing Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-green-100 p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pricing
                        </h3>

                        <!-- Price -->
                        <div class="mb-4">
                            <label class="block font-semibold mb-2 text-gray-700">Price (LKR)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500 font-semibold">Rs</span>
                                <div class="w-full pl-12 pr-4 py-3 rounded-lg border-2 border-green-200 bg-green-50 text-lg font-bold text-green-700">
                                    {{ number_format($item->prize, 2) }}
                                </div>
                            </div>
                        </div>

                        <!-- Installment Options -->
                        <div class="bg-gradient-to-br from-blue-50 to-pink-50 p-4 rounded-xl border border-blue-200">
                            <h4 class="font-semibold text-gray-700 mb-3 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Installment Plans
                            </h4>
                            
                            <div class="space-y-3">
                                <div class="bg-white p-3 rounded-lg border border-pink-200 shadow-sm">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">3 Months</label>
                                    <div class="relative">
                                        <span class="absolute left-2 top-2 text-gray-400 text-sm">Rs</span>
                                        <div class="w-full pl-8 py-2 rounded border border-gray-200 bg-gray-50 text-xl font-bold text-pink-600">
                                            {{ number_format($item->prize / 3, 2) }}
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">per month</p>
                                </div>
                                
                                <div class="bg-white p-3 rounded-lg border border-blue-200 shadow-sm">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">4 Months</label>
                                    <div class="relative">
                                        <span class="absolute left-2 top-2 text-gray-400 text-sm">Rs</span>
                                        <div class="w-full pl-8 py-2 rounded border border-gray-200 bg-gray-50 text-xl font-bold text-blue-600">
                                            {{ number_format($item->prize / 4, 2) }}
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">per month</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Availability Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-orange-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Availability
                        </h3>

                        <div>
                            <label class="block font-semibold mb-2 text-gray-700">Status</label>
                            <div class="w-full rounded-lg border-2 py-3 px-4 font-semibold text-center {{ $item->availability == 'in stock' ? 'border-green-300 bg-green-50 text-green-700' : 'border-red-300 bg-red-50 text-red-700' }}">
                                {{ $item->availability == 'in stock' ? '✓ In Stock' : '✗ Out of Stock' }}
                            </div>
                        </div>

                        <!-- Gift Card Display -->
                        @if($item->is_gift_card)
                        <div class="mt-6 pt-6 border-t border-orange-100">
                            <div class="bg-pink-50 border-2 border-pink-300 rounded-xl p-4">
                                <div class="flex items-center mb-3">
                                    <svg class="w-6 h-6 text-pink-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                    </svg>
                                    <span class="font-bold text-pink-700">Gift Card Item</span>
                                </div>
                                <div class="bg-white rounded-lg p-3 border border-pink-200">
                                    <p class="text-sm font-semibold text-gray-600 mb-1">Validity Period</p>
                                    <p class="text-2xl font-bold text-pink-600">{{ $item->gift_card_validity_months }} {{ $item->gift_card_validity_months == 1 ? 'Month' : 'Months' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Offer Display -->
                        @if($item->is_on_offer)
                        <div class="mt-6 pt-6 border-t border-orange-100">
                            <div class="bg-green-50 border-2 border-green-300 rounded-xl p-4">
                                <div class="flex items-center mb-3">
                                    <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span class="font-bold text-green-700">Special Offer Active</span>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="bg-white rounded-lg p-3 border border-green-200">
                                        <p class="text-sm font-semibold text-gray-600 mb-1">Discount</p>
                                        <p class="text-2xl font-bold text-green-600">{{ number_format($item->offer_percentage, 2) }}% OFF</p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="bg-white rounded-lg p-2 border border-green-200">
                                            <p class="text-xs text-gray-500 mb-1">Start Date</p>
                                            <p class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->offer_start_date)->format('M d, Y') }}</p>
                                        </div>
                                        <div class="bg-white rounded-lg p-2 border border-green-200">
                                            <p class="text-xs text-gray-500 mb-1">End Date</p>
                                            <p class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->offer_end_date)->format('M d, Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-green-100 to-blue-100 p-4 rounded-lg border-2 border-green-300">
                                        <p class="text-sm font-semibold text-gray-600 mb-2">Price After Discount</p>
                                        <div class="flex items-center gap-3">
                                            <span class="text-2xl font-bold text-green-700">
                                                Rs {{ number_format($item->prize - ($item->prize * $item->offer_percentage / 100), 2) }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                <span class="line-through">Rs {{ number_format($item->prize, 2) }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Total Value Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-purple-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Inventory Value
                        </h3>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-4 border border-purple-200">
                            <p class="text-sm font-semibold text-gray-600 mb-2">Total Stock Value</p>
                            <p class="text-3xl font-bold text-purple-700">Rs {{ number_format($item->prize * $item->stock_items, 2) }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $item->stock_items }} units × Rs {{ number_format($item->prize, 2) }}</p>
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
                // Smooth scroll to main image
                mainImage.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    </script>
</x-app-layout>