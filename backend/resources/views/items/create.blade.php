<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Create New Item</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-2 border-pink-100">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('name') border-red-500 @enderror" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div>
                                <label for="SKU" class="block text-sm font-semibold text-gray-700 mb-2">SKU *</label>
                                <input type="text" name="SKU" id="SKU" value="{{ old('SKU') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('SKU') border-red-500 @enderror" required>
                                @error('SKU')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                                <input type="text" name="category" id="category" value="{{ old('category') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('category') border-red-500 @enderror" required>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
                                <input type="text" name="type" id="type" value="{{ old('type') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('type') border-red-500 @enderror">
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Color -->
                            <div>
                                <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">Color *</label>
                                <input type="text" name="color" id="color" value="{{ old('color') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('color') border-red-500 @enderror" required>
                                @error('color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Material -->
                            <div>
                                <label for="material" class="block text-sm font-semibold text-gray-700 mb-2">Material *</label>
                                <input type="text" name="material" id="material" value="{{ old('material') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('material') border-red-500 @enderror" required>
                                @error('material')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prize -->
                            <div>
                                <label for="prize" class="block text-sm font-semibold text-gray-700 mb-2">Price (Sri Lankan Rupees) *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rs</span>
                                    </div>
                                    <input type="number" step="0.01" name="prize" id="prize" value="{{ old('prize') }}" 
                                        class="mt-1 block w-full pl-12 rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('prize') border-red-500 @enderror" required>
                                </div>
                                @error('prize')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stock Items -->
                            <div>
                                <label for="stock_items" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                                <input type="number" name="stock_items" id="stock_items" value="{{ old('stock_items') }}" 
                                    class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('stock_items') border-red-500 @enderror" required>
                                @error('stock_items')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-pink-200 border-dashed rounded-lg hover:border-pink-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-pink-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer rounded-md font-medium text-pink-600 hover:text-pink-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('items.index') }}" class="bg-white border-2 border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                                Create Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
