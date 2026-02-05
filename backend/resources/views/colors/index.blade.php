<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Colors Management
            </span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-md mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-8">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                    Manage your product colors
                </span>
            </div>

            <!-- Add Color -->
            <div class="bg-gradient-to-r from-pink-50 to-blue-50 rounded-xl shadow-md p-6 mb-6 border border-pink-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Color</h3>
                <form method="POST" action="{{ route('colors.store') }}" id="colorForm">
                    @csrf
                    <input type="hidden" name="name" id="selectedColorName" value="{{ old('name') }}">
                    <input type="hidden" name="hex_code" id="selectedColorHex" value="{{ old('hex_code') }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select a Color</label>
                        <div class="grid grid-cols-6 sm:grid-cols-8 md:grid-cols-10 lg:grid-cols-12 gap-2">
                            @php
                            $colorOptions = [
                                ['name' => 'Red', 'hex' => '#FF0000'],
                                ['name' => 'Pink', 'hex' => '#FFC0CB'],
                                ['name' => 'Rose', 'hex' => '#FF007F'],
                                ['name' => 'Magenta', 'hex' => '#FF00FF'],
                                ['name' => 'Purple', 'hex' => '#800080'],
                                ['name' => 'Violet', 'hex' => '#8B00FF'],
                                ['name' => 'Indigo', 'hex' => '#4B0082'],
                                ['name' => 'Blue', 'hex' => '#0000FF'],
                                ['name' => 'Navy', 'hex' => '#000080'],
                                ['name' => 'Cyan', 'hex' => '#00FFFF'],
                                ['name' => 'Teal', 'hex' => '#008080'],
                                ['name' => 'Aqua', 'hex' => '#00CED1'],
                                ['name' => 'Turquoise', 'hex' => '#40E0D0'],
                                ['name' => 'Green', 'hex' => '#008000'],
                                ['name' => 'Lime', 'hex' => '#00FF00'],
                                ['name' => 'Olive', 'hex' => '#808000'],
                                ['name' => 'Yellow', 'hex' => '#FFFF00'],
                                ['name' => 'Gold', 'hex' => '#FFD700'],
                                ['name' => 'Orange', 'hex' => '#FFA500'],
                                ['name' => 'Coral', 'hex' => '#FF7F50'],
                                ['name' => 'Salmon', 'hex' => '#FA8072'],
                                ['name' => 'Peach', 'hex' => '#FFDAB9'],
                                ['name' => 'Brown', 'hex' => '#8B4513'],
                                ['name' => 'Maroon', 'hex' => '#800000'],
                                ['name' => 'Burgundy', 'hex' => '#900020'],
                                ['name' => 'Beige', 'hex' => '#F5F5DC'],
                                ['name' => 'Tan', 'hex' => '#D2B48C'],
                                ['name' => 'Khaki', 'hex' => '#C3B091'],
                                ['name' => 'Cream', 'hex' => '#FFFDD0'],
                                ['name' => 'Ivory', 'hex' => '#FFFFF0'],
                                ['name' => 'White', 'hex' => '#FFFFFF'],
                                ['name' => 'Gray', 'hex' => '#808080'],
                                ['name' => 'Silver', 'hex' => '#C0C0C0'],
                                ['name' => 'Charcoal', 'hex' => '#36454F'],
                                ['name' => 'Black', 'hex' => '#000000'],
                                ['name' => 'Mint', 'hex' => '#98FF98'],
                                ['name' => 'Lavender', 'hex' => '#E6E6FA'],
                                ['name' => 'Lilac', 'hex' => '#C8A2C8'],
                                ['name' => 'Mauve', 'hex' => '#E0B0FF'],
                                ['name' => 'Plum', 'hex' => '#DDA0DD'],
                                ['name' => 'Sky Blue', 'hex' => '#87CEEB'],
                                ['name' => 'Royal Blue', 'hex' => '#4169E1'],
                                ['name' => 'Cobalt', 'hex' => '#0047AB'],
                                ['name' => 'Emerald', 'hex' => '#50C878'],
                                ['name' => 'Forest Green', 'hex' => '#228B22'],
                                ['name' => 'Sea Green', 'hex' => '#2E8B57'],
                                ['name' => 'Amber', 'hex' => '#FFBF00'],
                                ['name' => 'Rust', 'hex' => '#B7410E'],
                            ];
                            @endphp
                            
                            @foreach($colorOptions as $colorOption)
                                <div 
                                    class="color-option w-12 h-12 rounded-lg cursor-pointer border-2 border-gray-300 hover:border-pink-500 hover:scale-110 transition-all duration-200 shadow-md relative group"
                                    style="background-color: {{ $colorOption['hex'] }}"
                                    data-color-name="{{ $colorOption['name'] }}"
                                    data-color-hex="{{ $colorOption['hex'] }}"
                                    onclick="selectColor('{{ $colorOption['name'] }}', '{{ $colorOption['hex'] }}', this)"
                                >
                                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                                        {{ $colorOption['name'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex-1">
                            <div id="selectedColorDisplay" class="hidden">
                                <div class="flex items-center gap-3 bg-white px-4 py-3 rounded-lg border-2 border-pink-300">
                                    <div id="selectedColorSwatch" class="w-8 h-8 rounded border-2 border-gray-300"></div>
                                    <div>
                                        <div class="font-semibold text-gray-900" id="selectedColorDisplayName"></div>
                                        <div class="text-xs text-gray-500" id="selectedColorDisplayHex"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button
                            type="submit"
                            id="submitBtn"
                            disabled
                            class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white rounded-lg font-semibold px-8 py-3 hover:scale-105 transition-transform duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                        >
                            Add Color
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gradient-to-r from-pink-50 to-blue-50">
                    <h3 class="text-lg font-semibold text-gray-900">All Colors</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-center">
                        <thead>
                            <tr class="bg-gradient-to-r from-pink-50 to-blue-50 border-b">
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($colors as $color)
                                @php $editError = session('edit_error_id') == $color->id; @endphp

                                <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50">

                                    <!-- NAME -->
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center items-center gap-3">
                                            <span
                                                id="name-display-{{ $color->id }}"
                                                @if($editError) style="display:none" @endif
                                                class="flex items-center gap-3"
                                            >
                                                <div 
                                                    class="w-8 h-8 rounded border-2 border-gray-300 shadow-sm"
                                                    style="background-color: {{ $color->hex_code ?? '#CCCCCC' }}"
                                                ></div>
                                                <span class="font-semibold text-pink-600">{{ $color->name }}</span>
                                            </span>

                                            <form
                                                id="edit-form-{{ $color->id }}"
                                                method="POST"
                                                action="{{ route('colors.update', $color->id) }}"
                                                @if(!$editError) style="display:none" @endif
                                            >
                                                @csrf
                                                @method('PUT')
                                                <input
                                                    id="name-input-{{ $color->id }}"
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name', $color->name) }}"
                                                    class="border rounded-lg px-3 py-2 focus:ring-pink-500"
                                                >
                                            </form>
                                        </div>
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="px-6 py-4">
                                        <div
                                            id="action-buttons-{{ $color->id }}"
                                            @if($editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                onclick="enableEdit({{ $color->id }})"
                                                class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg
                                                        border border-amber-200
                                                        hover:bg-amber-200 hover:text-amber-700 hover:border-amber-500
                                                        transition-all duration-200 ease-in-out
                                                        hover:shadow-md hover:-translate-y-0.5"
                                                         >
                                                Edit
                                            </button>

                                            <form
                                                method="POST"
                                                action="{{ route('colors.destroy', $color->id) }}"
                                                onsubmit="return confirm('Are you sure?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg
                                                        border border-red-200
                                                        hover:bg-red-200 hover:text-red-700 hover:border-red-500
                                                        transition-all duration-200 ease-in-out
                                                        hover:shadow-md hover:-translate-y-0.5"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                        <div
                                            id="edit-buttons-{{ $color->id }}"
                                            @if(!$editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                onclick="document.getElementById('edit-form-{{ $color->id }}').submit()"
                                                class="bg-green-50 text-green-700 px-4 py-2 rounded-lg border border-green-200 hover:bg-green-100 transition"
                                            >
                                                Save
                                            </button>
                                            <button
                                                onclick="cancelEdit({{ $color->id }})"
                                                class="bg-gray-50 text-gray-700 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-100 transition"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-12 text-center text-gray-500">
                                        No colors found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectColor(name, hex, element) {
            // Remove selected class from all color options
            document.querySelectorAll('.color-option').forEach(el => {
                el.classList.remove('ring-4', 'ring-pink-500', 'border-pink-500', 'scale-110');
            });
            
            // Add selected class to clicked element
            element.classList.add('ring-4', 'ring-pink-500', 'border-pink-500', 'scale-110');
            
            // Update hidden inputs
            document.getElementById('selectedColorName').value = name;
            document.getElementById('selectedColorHex').value = hex;
            
            // Show selected color display
            const display = document.getElementById('selectedColorDisplay');
            display.classList.remove('hidden');
            
            // Update display
            document.getElementById('selectedColorSwatch').style.backgroundColor = hex;
            document.getElementById('selectedColorDisplayName').textContent = name;
            document.getElementById('selectedColorDisplayHex').textContent = hex;
            
            // Enable submit button
            document.getElementById('submitBtn').disabled = false;
        }

        function enableEdit(id) {
            document.getElementById('name-display-' + id).style.display = 'none';
            document.getElementById('edit-form-' + id).style.display = 'block';
            document.getElementById('action-buttons-' + id).style.display = 'none';
            document.getElementById('edit-buttons-' + id).style.display = 'flex';
        }

        function cancelEdit(id) {
            document.getElementById('name-display-' + id).style.display = 'block';
            document.getElementById('edit-form-' + id).style.display = 'none';
            document.getElementById('action-buttons-' + id).style.display = 'flex';
            document.getElementById('edit-buttons-' + id).style.display = 'none';
        }
    </script>
</x-app-layout>
