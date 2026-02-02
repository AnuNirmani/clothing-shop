<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Edit Item
            </span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-2xl border border-pink-100">
                <div class="p-10">

                    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">

                            <!-- Name -->
                            <div>
                                <label class="block font-semibold mb-2">Name *</label>
                                <input type="text" name="name"
                                    value="{{ old('name', $item->name) }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block font-semibold mb-2">SKU *</label>
                                <input type="text" name="SKU"
                                    value="{{ old('SKU', $item->SKU) }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block font-semibold mb-2">Category *</label>
                                <input type="text" name="category"
                                    value="{{ old('category', $item->category) }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Type -->
                            <div>
                                <label class="block font-semibold mb-2">Type</label>
                                <select name="type_id"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">
                                    <option value="">Select type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('type_id', $item->type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block font-semibold mb-2">Color *</label>
                                <input type="text" name="color"
                                    value="{{ old('color', $item->color) }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Material -->
                            <div>
                                <label class="block font-semibold mb-2">Material *</label>
                                <input type="text" name="material"
                                    value="{{ old('material', $item->material) }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Price -->
                            <div>
                                <label class="block font-semibold mb-2">Price (LKR) *</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-gray-500">Rs</span>
                                    <input type="number" step="0.01" name="prize"
                                        value="{{ old('prize', $item->prize) }}"
                                        class="w-full pl-12 rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                        required>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div>
                                <label class="block font-semibold mb-2">Stock Quantity *</label>
                                <input type="number" name="stock_items"
                                    value="{{ old('stock_items', $item->stock_items) }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Current Image -->
                            @if($item->image)
                                <div>
                                    <label class="block font-semibold mb-2">Current Image</label>
                                    <img src="{{ asset('storage/'.$item->image) }}"
                                         class="h-48 w-48 object-cover rounded-xl border border-pink-200 shadow-md">
                                </div>
                            @endif

                            <!-- Image Upload -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    {{ $item->image ? 'Change Image' : 'Image' }}
                                </label>
                                <div
                                    class="flex justify-center px-6 py-10 border-2 border-dashed border-pink-200 rounded-xl hover:border-pink-400">
                                    <label class="cursor-pointer text-center">
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
                                    </label>
                                </div>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-10 flex justify-end gap-4">
                            <a href="{{ route('items.index') }}"
                                class="px-6 py-3 border rounded-lg text-gray-700 hover:bg-gray-100 hover:scale-105 transition-transform duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-pink-500 to-blue-500 
                                       hover:from-pink-600 hover:to-blue-600 
                                       text-white rounded-lg font-bold shadow-lg 
                                       hover:scale-105 transition-transform duration-200">
                                Update Item
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
