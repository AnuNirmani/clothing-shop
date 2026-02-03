<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Create New Item
            </span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg shadow-md mb-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mr-3 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold mb-2">Please fix the following errors:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-2xl rounded-2xl border border-pink-100">
                <div class="p-10">

                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">

                            <!-- Name -->
                            <div>
                                <label class="block font-semibold mb-2">Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Co Name -->
                            <div>
                                <label class="block font-semibold mb-2">Co Name</label>
                                <input type="text" name="co_name" value="{{ old('co_name') }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block font-semibold mb-2">Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">{{ old('description') }}</textarea>
                            </div>

                            <!-- Note -->
                            <div>
                                <label class="block font-semibold mb-2">Note</label>
                                <textarea name="note" rows="3"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">{{ old('note') }}</textarea>
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block font-semibold mb-2">SKU *</label>
                                <input type="text" name="SKU" value="{{ old('SKU') }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block font-semibold mb-2">Category</label>
                                <select name="category_id"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Type -->
                            <div>
                                <label class="block font-semibold mb-2">Type</label>
                                <select name="type_id"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">
                                    <option value="">Select type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Classification -->
                            <div>
                                <label class="block font-semibold mb-2">Classification</label>
                                <select name="classification_id"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400">
                                    <option value="">Select classification</option>
                                    @foreach($classifications as $classification)
                                        <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block font-semibold mb-2">Color *</label>
                                <input type="text" name="color" value="{{ old('color') }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Material -->
                            <div>
                                <label class="block font-semibold mb-2">Material *</label>
                                <input type="text" name="material" value="{{ old('material') }}"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Price -->
                            <div>
                                <label class="block font-semibold mb-2">Price (LKR) *</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-gray-500">Rs</span>
                                    <input type="number" step="0.01" name="prize" id="prize"
                                        class="w-full pl-12 rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                        oninput="calculateInstallments()"
                                        required>
                                </div>
                            </div>

                            <!-- Installment Options -->
                            <div class="bg-gradient-to-r from-blue-50 to-pink-50 p-4 rounded-lg border border-blue-200">
                                <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Installment Options
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white p-3 rounded-lg border border-pink-200">
                                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">3 Installments</label>
                                        <div class="relative">
                                            <span class="absolute left-2 top-2 text-gray-400 text-sm">Rs</span>
                                            <input type="text" id="installment_3" readonly
                                                class="w-full pl-8 py-2 rounded border-gray-200 bg-gray-50 text-lg font-bold text-pink-600"
                                                value="0.00">
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">per month</p>
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-blue-200">
                                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">4 Installments</label>
                                        <div class="relative">
                                            <span class="absolute left-2 top-2 text-gray-400 text-sm">Rs</span>
                                            <input type="text" id="installment_4" readonly
                                                class="w-full pl-8 py-2 rounded border-gray-200 bg-gray-50 text-lg font-bold text-blue-600"
                                                value="0.00">
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">per month</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div>
                                <label class="block font-semibold mb-2">Stock Quantity *</label>
                                <input type="number" name="stock_items"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                            </div>

                            <!-- Availability -->
                            <div>
                                <label class="block font-semibold mb-2">Availability *</label>
                                <select name="availability"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                    required>
                                    <option value="in stock" {{ old('availability') == 'in stock' ? 'selected' : '' }}>In Stock</option>
                                    <option value="out of stock" {{ old('availability') == 'out of stock' ? 'selected' : '' }}>Out of Stock</option>
                                </select>
                            </div>

                            <!-- Image -->
                            <div>
                                <label class="block font-semibold mb-2">Main Image</label>
                                
                                <!-- Preview Container -->
                                <div id="main-image-preview" class="hidden mb-3">
                                    <img id="main-preview-img" class="h-48 w-48 object-cover rounded-xl border border-pink-200 shadow-md">
                                    <button type="button" onclick="removeMainPreview()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                        Remove
                                    </button>
                                </div>

                                <div id="main-image-upload"
                                    class="flex justify-center px-6 py-10 border-2 border-dashed border-pink-200 rounded-xl hover:border-pink-400">
                                    <label class="cursor-pointer text-center">
                                        <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-pink-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer rounded-md font-medium text-pink-600 hover:text-pink-500 focus-within:outline-none">
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

                            <!-- Additional Photos -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block font-semibold">Additional Photos</label>
                                    <span class="text-xs text-gray-500">Max 20 photos</span>
                                </div>
                                
                                <div id="photo-container" class="space-y-3">
                                    <!-- Photo inputs will be added here dynamically -->
                                </div>

                                <button type="button" id="add-photo-btn"
                                    class="mt-3 w-full px-4 py-2 bg-gradient-to-r from-blue-50 to-pink-50 border-2 border-dashed border-blue-300 text-blue-600 rounded-lg hover:border-blue-400 hover:bg-gradient-to-r hover:from-blue-100 hover:to-pink-100 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span class="font-semibold">Add Photo</span>
                                </button>
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
                                Create Item
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        let photoCount = 0;
        const maxPhotos = 20;

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
            if (photoCount >= maxPhotos) {
                alert('Maximum 20 photos allowed');
                return;
            }

            const photoContainer = document.getElementById('photo-container');
            const photoId = 'photo-' + Date.now();
            const photoDiv = document.createElement('div');
            photoDiv.className = 'flex items-start gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200';
            photoDiv.innerHTML = `
                <div class="flex-1">
                    <input type="file" name="photos[]" accept="image/*" 
                        onchange="previewAdditionalPhoto(event, '${photoId}')"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                    <div id="${photoId}" class="hidden mt-2">
                        <img class="h-32 w-32 object-cover rounded-lg border border-pink-200 shadow-sm">
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
            
            if (photoCount >= maxPhotos) {
                document.getElementById('add-photo-btn').disabled = true;
                document.getElementById('add-photo-btn').classList.add('opacity-50', 'cursor-not-allowed');
            }
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
            
            const addBtn = document.getElementById('add-photo-btn');
            if (photoCount < maxPhotos) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>
</x-app-layout>
