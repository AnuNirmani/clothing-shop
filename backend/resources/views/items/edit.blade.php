<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Edit Item
            </span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                                    <label class="block font-semibold mb-2 text-gray-700">Name *</label>
                                    <input type="text" name="name" value="{{ old('name', $item->name) }}"
                                        class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                        required>
                                </div>

                                <!-- Co Name -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Co Name</label>
                                    <input type="text" name="co_name" value="{{ old('co_name', $item->co_name) }}"
                                        class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">
                                </div>

                                <!-- SKU -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">SKU *</label>
                                    <input type="text" name="SKU" value="{{ old('SKU', $item->SKU) }}"
                                        class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                        required>
                                </div>

                                <!-- Stock -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Stock Quantity *</label>
                                    <input type="number" name="stock_items" value="{{ old('stock_items', $item->stock_items) }}"
                                        class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                        required>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mt-4">
                                <label class="block font-semibold mb-2 text-gray-700">Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">{{ old('description', $item->description) }}</textarea>
                            </div>

                            <!-- Note -->
                            <div class="mt-4">
                                <label class="block font-semibold mb-2 text-gray-700">Note</label>
                                <textarea name="note" rows="3"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">{{ old('note', $item->note) }}</textarea>
                            </div>
                        </div>

                        <!-- Categories & Attributes Card -->
                        <div class="bg-white shadow-lg rounded-2xl border border-blue-100 p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Categories & Attributes
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Category -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Category</label>
                                    <select name="category_id"
                                        class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400">
                                        <!-- <option value="">Select category</option> -->
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Type -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Type</label>
                                    <select name="type_id"
                                        class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400">
                                        <!-- <option value="">Select type</option> -->
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('type_id', $item->type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Classification -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Classification</label>
                                    <select name="classification_id"
                                        class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400">
                                        <!-- <option value="">Select classification</option> -->
                                        @foreach($classifications as $classification)
                                            <option value="{{ $classification->id }}"
                                                {{ old('classification_id', $item->classification_id) == $classification->id ? 'selected' : '' }}>
                                                {{ $classification->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Color -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Color</label>
                                    <div class="relative">
                                        <input type="hidden" name="color_id" id="colorIdInput" value="{{ old('color_id', $item->color_id) }}">
                                        <div id="colorSelectDisplay" class="w-full rounded-lg border border-blue-200 px-4 py-2 cursor-pointer bg-white flex items-center justify-between hover:border-blue-400">
                                            <span id="selectedColorText" class="text-gray-500">Select color</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                        <div id="colorDropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                            <div class="px-4 py-2 text-gray-500 bg-gray-50 hover:bg-gray-100 cursor-pointer" data-color-id="" data-color-name="Select color">
                                                Select color
                                            </div>
                                            @foreach($colors as $color)
                                                <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-3" 
                                                     data-color-id="{{ $color->id }}" 
                                                     data-color-name="{{ $color->name }}"
                                                     data-color-hex="{{ $color->hex_code }}">
                                                    <div class="w-6 h-6 rounded border-2 border-gray-300" style="background-color: {{ $color->hex_code ?? '#CCCCCC' }}"></div>
                                                    <span>{{ $color->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Material -->
                                <div>
                                    <label class="block font-semibold mb-2 text-gray-700">Material</label>
                                    <select name="material_id"
                                        class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400">
                                        <!-- <option value="">Select material</option> -->
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}"
                                                {{ old('material_id', $item->material_id) == $material->id ? 'selected' : '' }}>
                                                {{ $material->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Size -->
                                <div class="md:col-span-2">
                                    <label class="block font-semibold mb-3 text-gray-700">Size</label>
                                    
                                    <!-- Radio Buttons for Common Sizes -->
                                    <div class="flex flex-wrap gap-3 mb-4">
                                        @foreach($sizes as $size)
                                            @if(in_array(strtoupper($size->name), ['S', 'M', 'L', 'XL', 'XXL']))
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="radio" name="size_id" value="{{ $size->id }}" 
                                                        class="sr-only peer" 
                                                        {{ old('size_id', $item->size_id) == $size->id ? 'checked' : '' }}>
                                                    <div class="px-6 py-3 rounded-lg border-2 border-gray-300 bg-white peer-checked:border-pink-500 peer-checked:bg-gradient-to-r peer-checked:from-pink-50 peer-checked:to-blue-50 peer-checked:text-pink-700 font-semibold transition-all duration-200 hover:border-pink-300 hover:shadow-md">
                                                        {{ $size->name }}
                                                    </div>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <!-- Dropdown for All Sizes -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Select Item if you want:</label>
                                        <select name="size_id_dropdown" id="sizeDropdown"
                                            class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400">
                                            <!-- <option value="">Select size</option> -->
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}" {{ old('size_id', $item->size_id) == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
                                            @endforeach
                                        </select>
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

                            <!-- Current Main Image -->
                            @if($item->image)
                                <div class="mb-6">
                                    <label class="block font-semibold mb-2 text-gray-700">Current Main Image</label>
                                    <div class="relative inline-block">
                                        <img src="{{ asset('storage/'.$item->image) }}"
                                             class="h-48 w-48 object-cover rounded-xl border-2 border-purple-200 shadow-md">
                                        <div class="absolute top-2 right-2 bg-purple-500 text-white text-xs px-2 py-1 rounded-full">
                                            Main
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Change Main Image -->
                            <div class="mb-6">
                                <label class="block font-semibold mb-2 text-gray-700">
                                    {{ $item->image ? 'Change Main Image' : 'Main Image' }}
                                </label>
                                
                                <!-- Preview Container for new upload -->
                                <div id="main-image-preview" class="hidden mb-3">
                                    <img id="main-preview-img" class="h-48 w-48 object-cover rounded-xl border-2 border-purple-200 shadow-md">
                                    <button type="button" onclick="removeMainPreview()" 
                                        class="mt-2 px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                                        Remove New Image
                                    </button>
                                </div>

                                <div id="main-image-upload"
                                    class="flex justify-center px-6 py-10 border-2 border-dashed border-purple-200 rounded-xl hover:border-purple-400 transition-colors">
                                    <label class="cursor-pointer text-center">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-purple-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative cursor-pointer rounded-md font-medium text-purple-600 hover:text-purple-500">
                                                    <span>Upload a file</span>
                                                    <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewMainImage(event)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Existing Additional Photos -->
                            @if($item->photos && $item->photos->count() > 0)
                                <div class="mb-6">
                                    <div class="flex justify-between items-center mb-3">
                                        <label class="block font-semibold text-gray-700">Existing Photos</label>
                                        <span class="text-xs text-gray-500 bg-purple-100 px-3 py-1 rounded-full">
                                            {{ $item->photos->count() }}/20
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-3">
                                        @foreach($item->photos as $photo)
                                            <div class="relative group">
                                                <img src="{{ asset('storage/'.$photo->photo_path) }}" 
                                                     class="w-full h-32 object-cover rounded-lg border-2 border-purple-200 shadow-sm transition-all group-hover:border-purple-400">
                                                <label class="absolute top-2 right-2 bg-white rounded-lg p-1.5 shadow-md cursor-pointer hover:bg-red-50 transition-colors flex items-center gap-1">
                                                    <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" 
                                                           class="form-checkbox h-4 w-4 text-red-600 rounded border-gray-300 focus:ring-red-500">
                                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="text-xs text-gray-500 bg-yellow-50 border border-yellow-200 rounded-lg px-3 py-2 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        Check the boxes to mark photos for deletion
                                    </p>
                                </div>
                            @endif

                            <!-- Add More Photos -->
                            <div>
                                <div class="flex justify-between items-center mb-3">
                                    <label class="block font-semibold text-gray-700">Add More Photos</label>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Max 20 total</span>
                                </div>
                                
                                <div id="photo-container" class="space-y-3 mb-3">
                                    <!-- Photo inputs will be added here dynamically -->
                                </div>

                                <button type="button" id="add-photo-btn"
                                    class="w-full px-4 py-3 bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-dashed border-purple-300 text-purple-600 rounded-lg hover:border-purple-400 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span class="font-semibold">Add Photo</span>
                                </button>
                            </div>
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
                                <label class="block font-semibold mb-2 text-gray-700">Price (LKR) *</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500 font-semibold">Rs</span>
                                    <input type="number" step="0.01" name="prize" id="prize"
                                        value="{{ old('prize', $item->prize) }}"
                                        class="w-full pl-12 pr-4 py-3 rounded-lg border-green-200 focus:ring-green-300 focus:border-green-400 text-lg font-bold"
                                        oninput="calculateInstallments()"
                                        required>
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
                                            <input type="text" id="installment_3" readonly
                                                class="w-full pl-8 py-2 rounded border-gray-200 bg-gray-50 text-xl font-bold text-pink-600"
                                                value="{{ number_format($item->prize / 3, 2) }}">
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">per month</p>
                                    </div>
                                    
                                    <div class="bg-white p-3 rounded-lg border border-blue-200 shadow-sm">
                                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">4 Months</label>
                                        <div class="relative">
                                            <span class="absolute left-2 top-2 text-gray-400 text-sm">Rs</span>
                                            <input type="text" id="installment_4" readonly
                                                class="w-full pl-8 py-2 rounded border-gray-200 bg-gray-50 text-xl font-bold text-blue-600"
                                                value="{{ number_format($item->prize / 4, 2) }}">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Availability
                            </h3>

                            <div>
                                <label class="block font-semibold mb-2 text-gray-700">Status *</label>
                                <select name="availability"
                                    class="w-full rounded-lg border-orange-200 focus:ring-orange-300 focus:border-orange-400 py-3"
                                    required>
                                    <option value="in stock" {{ old('availability', $item->availability) == 'in stock' ? 'selected' : '' }}>
                                        ✓ In Stock
                                    </option>
                                    <option value="out of stock" {{ old('availability', $item->availability) == 'out of stock' ? 'selected' : '' }}>
                                        ✗ Out of Stock
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full px-6 py-4 bg-gradient-to-r from-pink-500 to-blue-500 
                                           hover:from-pink-600 hover:to-blue-600 
                                           text-white rounded-xl font-bold shadow-lg 
                                           hover:scale-105 transition-all duration-200
                                           flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Update Item
                                </button>
                                
                                <a href="{{ route('items.index') }}"
                                    class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl text-gray-700 
                                           hover:bg-white hover:border-gray-400 hover:scale-105 
                                           transition-all duration-200 font-semibold
                                           flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <script>
        let photoCount = 0;
        const existingPhotos = {{ $item->photos ? $item->photos->count() : 0 }};
        const maxPhotos = 20;

        // Update button state on page load
        updateAddButtonState();

        // Installment calculation function
        function calculateInstallments() {
            const price = parseFloat(document.getElementById('prize').value) || 0;
            const installment3 = price / 3;
            const installment4 = price / 4;
            
            document.getElementById('installment_3').value = installment3.toFixed(2);
            document.getElementById('installment_4').value = installment4.toFixed(2);
        }

        // Main image preview functions
        function previewMainImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('main-preview-img').src = e.target.result;
                    document.getElementById('main-image-preview').classList.remove('hidden');
                    document.getElementById('main-image-upload').classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function removeMainPreview() {
            document.getElementById('image').value = '';
            document.getElementById('main-image-preview').classList.add('hidden');
            document.getElementById('main-image-upload').classList.remove('hidden');
        }

        // Additional photos functions
        document.getElementById('add-photo-btn').addEventListener('click', function() {
            const totalPhotos = existingPhotos + photoCount;
            
            if (totalPhotos >= maxPhotos) {
                alert('Maximum 20 photos allowed');
                return;
            }

            const photoContainer = document.getElementById('photo-container');
            const photoId = 'photo-' + Date.now();
            const photoDiv = document.createElement('div');
            photoDiv.className = 'flex items-start gap-3 p-3 bg-gradient-to-r from-gray-50 to-purple-50 rounded-lg border border-purple-200';
            photoDiv.innerHTML = `
                <div class="flex-1">
                    <input type="file" name="photos[]" accept="image/*" 
                        onchange="previewAdditionalPhoto(event, '${photoId}')"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                    <div id="${photoId}" class="hidden mt-2">
                        <img class="h-32 w-32 object-cover rounded-lg border-2 border-purple-200 shadow-sm">
                    </div>
                </div>
                <button type="button" onclick="removePhoto(this)" 
                    class="flex-shrink-0 p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            `;
            
            photoContainer.appendChild(photoDiv);
            photoCount++;
            updateAddButtonState();
        });

        function previewAdditionalPhoto(event, photoId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById(photoId);
                    const img = previewContainer.querySelector('img');
                    img.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function removePhoto(button) {
            button.closest('div.flex').remove();
            photoCount--;
            updateAddButtonState();
        }

        function updateAddButtonState() {
            const totalPhotos = existingPhotos + photoCount;
            const addBtn = document.getElementById('add-photo-btn');
            
            if (totalPhotos >= maxPhotos) {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        // Color dropdown functionality
        const colorSelectDisplay = document.getElementById('colorSelectDisplay');
        const colorDropdown = document.getElementById('colorDropdown');
        const colorIdInput = document.getElementById('colorIdInput');
        const selectedColorText = document.getElementById('selectedColorText');

        colorSelectDisplay.addEventListener('click', function(e) {
            e.stopPropagation();
            colorDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function() {
            colorDropdown.classList.add('hidden');
        });

        colorDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            const option = e.target.closest('[data-color-id]');
            if (option) {
                const colorId = option.getAttribute('data-color-id');
                const colorName = option.getAttribute('data-color-name');
                const colorHex = option.getAttribute('data-color-hex');
                
                colorIdInput.value = colorId;
                
                if (colorId && colorHex) {
                    selectedColorText.innerHTML = `
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded border-2 border-gray-300" style="background-color: ${colorHex}"></div>
                            <span class="text-gray-900">${colorName}</span>
                        </div>
                    `;
                } else {
                    selectedColorText.innerHTML = '<span class="text-gray-500">Select color</span>';
                }
                
                colorDropdown.classList.add('hidden');
            }
        });

        // Set initial selected color on page load
        window.addEventListener('DOMContentLoaded', function() {
            const initialColorId = colorIdInput.value;
            if (initialColorId) {
                const selectedOption = document.querySelector(`[data-color-id="${initialColorId}"]`);
                if (selectedOption) {
                    const colorName = selectedOption.getAttribute('data-color-name');
                    const colorHex = selectedOption.getAttribute('data-color-hex');
                    if (colorHex) {
                        selectedColorText.innerHTML = `
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded border-2 border-gray-300" style="background-color: ${colorHex}"></div>
                                <span class="text-gray-900">${colorName}</span>
                            </div>
                        `;
                    }
                }
            }
        });

        // Size radio buttons and dropdown sync
        const sizeRadios = document.querySelectorAll('input[name="size_id"]');
        const sizeDropdown = document.getElementById('sizeDropdown');
        
        // When radio button is clicked, update dropdown
        sizeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    sizeDropdown.value = this.value;
                }
            });
        });
        
        // When dropdown is changed, update radio button
        sizeDropdown.addEventListener('change', function() {
            const selectedValue = this.value;
            sizeRadios.forEach(radio => {
                if (radio.value === selectedValue) {
                    radio.checked = true;
                } else {
                    radio.checked = false;
                }
            });
        });
    </script>
</x-app-layout>