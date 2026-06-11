<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Site Settings</span>
        </h2>
    </x-slot>

    <div class="p-4 md:p-8" style="background: linear-gradient(135deg, #fdf2f8 0%, #f0f9ff 55%, #fdf4ff 100%); min-height: calc(100vh - 65px);">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex flex-col lg:flex-row gap-6 lg:items-start lg:justify-between">
                    <div class="max-w-xl">
                        <p class="text-[10px] font-bold text-purple-400 uppercase tracking-[0.3em] mb-1">Homepage</p>
                        <h3 class="font-display text-2xl font-semibold text-gray-800">Hero Media</h3>
                        <p class="mt-2 text-sm text-gray-500">Upload an image or video. Video takes priority on the homepage if both are set.</p>

                        @if(session('success'))
                            <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm text-emerald-700">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('site-settings.hero-media.update') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
                            @csrf

                            <div>
                                <label for="hero_image" class="block text-sm font-semibold text-gray-700 mb-2">Hero image</label>
                                <input id="hero_image" name="hero_image" type="file" accept="image/jpeg,image/png,image/webp,image/jpg"
                                       class="block w-full rounded-xl border border-gray-200 px-3 py-2 text-sm text-gray-700 file:mr-3 file:rounded-lg file:border-0 file:bg-purple-100 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-purple-700 hover:file:bg-purple-200">
                                @error('hero_image')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="hero_video" class="block text-sm font-semibold text-gray-700 mb-2">Hero video</label>
                                <input id="hero_video" name="hero_video" type="file" accept="video/mp4,video/webm,video/quicktime"
                                       class="block w-full rounded-xl border border-gray-200 px-3 py-2 text-sm text-gray-700 file:mr-3 file:rounded-lg file:border-0 file:bg-purple-100 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-purple-700 hover:file:bg-purple-200">
                                @error('hero_video')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-400">Max video size: 50MB.</p>
                            </div>

                            <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-95">
                                Save Site Settings
                            </button>
                        </form>
                    </div>

                    <div class="w-full lg:w-[360px]">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-[0.2em] mb-2">Current Hero</p>
                        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-gray-50">
                            @if($homeHeroVideo)
                                <video src="{{ asset('storage/' . $homeHeroVideo) }}" class="h-52 w-full object-cover" autoplay muted loop playsinline controls></video>
                            @else
                                <img src="{{ $homeHeroImage ? asset('storage/' . $homeHeroImage) : asset('images/hero01.png') }}" alt="Current hero" class="h-52 w-full object-cover">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hero Buttons --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <p class="text-[10px] font-bold text-purple-400 uppercase tracking-[0.3em] mb-1">Homepage</p>
                <h3 class="font-display text-2xl font-semibold text-gray-800">Hero Buttons</h3>
                <p class="mt-1 text-sm text-gray-500">Add up to 4 buttons displayed in the bottom-left corner of the hero section.</p>

                @if(session('buttons_success'))
                    <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm text-emerald-700">
                        {{ session('buttons_success') }}
                    </div>
                @endif

                @php
                    $baseLinkOptions = [
                        '/shop?title=Our Collection',
                        "/shop?category_id=1&title=Men's Wear",
                        "/shop?category_id=2&title=Women's Wear",
                        '/shop?category_id=3&title=Kids Wear',
                        '/shop?category_id=4&title=Accessories',
                        '/shop?category_id=5&title=Footwear',
                    ];

                    $offerLinkOptions = $offerCategories->map(function ($offerCategory) {
                        return [
                            'value' => '/shop?offer_category_id=' . $offerCategory->id . '&title=' . urlencode($offerCategory->name),
                            'label' => 'Offer: ' . $offerCategory->name,
                        ];
                    })->values();

                    $baseLinkOptionPairs = [
                        ['value' => '/shop?title=Our Collection', 'label' => 'Shop All'],
                        ['value' => "/shop?category_id=1&title=Men's Wear", 'label' => "Men's Wear"],
                        ['value' => "/shop?category_id=2&title=Women's Wear", 'label' => "Women's Wear"],
                        ['value' => '/shop?category_id=3&title=Kids Wear', 'label' => 'Kids Wear'],
                        ['value' => '/shop?category_id=4&title=Accessories', 'label' => 'Accessories'],
                        ['value' => '/shop?category_id=5&title=Footwear', 'label' => 'Shoes'],
                    ];

                    $allLinkOptions = array_merge($baseLinkOptionPairs, $offerLinkOptions->toArray());
                    $presetLinks = array_map(fn($opt) => $opt['value'], $allLinkOptions);
                @endphp

                <form action="{{ route('site-settings.hero-buttons.update') }}" method="POST" class="mt-6" id="hero-buttons-form">
                    @csrf

                    <div id="buttons-container" class="space-y-4">
                        @foreach($heroButtons as $i => $btn)
                            @php $isCustom = !in_array($btn['link'], $presetLinks); @endphp
                            <div class="button-row flex flex-wrap items-end gap-3 p-4 rounded-xl border border-gray-200 bg-gray-50">
                                <input type="hidden" name="buttons[{{ $i }}][link]" class="link-hidden" value="{{ $btn['link'] }}">
                                <div class="flex-1 min-w-[140px]">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Label</label>
                                    <input type="text" name="buttons[{{ $i }}][label]" value="{{ $btn['label'] }}"
                                           placeholder="e.g. Shop Now" maxlength="50" required
                                           class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                                </div>
                                <div class="flex-1 min-w-[180px]">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Link</label>
                                    <select class="link-select w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300"
                                            onchange="handleLinkChange(this)">
                                        @foreach($allLinkOptions as $opt)
                                            <option value="{{ $opt['value'] }}" {{ !$isCustom && $btn['link'] === $opt['value'] ? 'selected' : '' }}>{{ $opt['label'] }}</option>
                                        @endforeach
                                        <option value="custom" {{ $isCustom ? 'selected' : '' }}>Custom URL</option>
                                    </select>
                                    <input type="text" placeholder="/custom-path"
                                           value="{{ $isCustom ? $btn['link'] : '' }}"
                                           oninput="this.previousElementSibling.previousElementSibling.value = this.value"
                                           class="custom-url-input mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300 {{ $isCustom ? '' : 'hidden' }}">
                                </div>
                                <div class="flex items-end gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Button Color</label>
                                        <input type="color" name="buttons[{{ $i }}][bg_color]" value="{{ $btn['bg_color'] ?? '#7c3aed' }}"
                                               class="h-9 w-14 cursor-pointer rounded-lg border border-gray-200 p-1">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Text Color</label>
                                        <input type="color" name="buttons[{{ $i }}][text_color]" value="{{ $btn['text_color'] ?? '#ffffff' }}"
                                               class="h-9 w-14 cursor-pointer rounded-lg border border-gray-200 p-1">
                                    </div>
                                    <button type="button" onclick="this.closest('.button-row').remove(); reindexButtons()"
                                            class="h-9 px-3 rounded-lg border border-red-200 bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-100">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 flex items-center gap-3">
                        <button type="button" id="add-button-btn"
                                onclick="addButtonRow()"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-purple-300 bg-purple-50 px-4 py-2 text-sm font-semibold text-purple-700 hover:bg-purple-100">
                            + Add Button
                        </button>
                        <button type="submit"
                                class="inline-flex items-center rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-95">
                            Save Buttons
                        </button>
                    </div>
                </form>
            </div>

            {{-- Store Locations --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <p class="text-[10px] font-bold text-purple-400 uppercase tracking-[0.3em] mb-1">Homepage</p>
                <h3 class="font-display text-2xl font-semibold text-gray-800">Store Locations</h3>
                <p class="mt-1 text-sm text-gray-500">Manage the store cards shown in the "Visit Our Stores" section.</p>

                @if(session('stores_success'))
                    <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm text-emerald-700">
                        {{ session('stores_success') }}
                    </div>
                @endif

                <form action="{{ route('site-settings.stores.update') }}" method="POST" class="mt-6" id="stores-form">
                    @csrf

                    <div id="stores-container" class="space-y-4">
                        @foreach($stores as $i => $store)
                            <div class="store-row rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Store Name</label>
                                        <input type="text" name="stores[{{ $i }}][name]" value="{{ $store['name'] ?? '' }}" maxlength="120" required
                                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Address</label>
                                        <input type="text" name="stores[{{ $i }}][address]" value="{{ $store['address'] ?? '' }}" maxlength="255" required
                                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                                        <input type="email" name="stores[{{ $i }}][email]" value="{{ $store['email'] ?? '' }}" maxlength="120"
                                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Phone</label>
                                        <input type="text" name="stores[{{ $i }}][phone]" value="{{ $store['phone'] ?? '' }}" maxlength="60"
                                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                                    </div>
                                </div>
                                <div class="mt-3 flex justify-end">
                                    <button type="button" onclick="this.closest('.store-row').remove(); reindexStores()"
                                            class="h-9 px-3 rounded-lg border border-red-200 bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-100">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 flex items-center gap-3">
                        <button type="button" id="add-store-btn"
                                onclick="addStoreRow()"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-purple-300 bg-purple-50 px-4 py-2 text-sm font-semibold text-purple-700 hover:bg-purple-100">
                            + Add Store
                        </button>
                        <button type="submit"
                                class="inline-flex items-center rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-95">
                            Save Stores
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Past Hero Images</h4>
                    <div class="grid grid-cols-2 gap-3">
                        @forelse($heroImageHistory as $media)
                            <div class="overflow-hidden rounded-xl border {{ $media->is_active ? 'border-pink-400 ring-1 ring-pink-300' : 'border-gray-200' }}">
                                <img src="{{ asset('storage/' . $media->media_path) }}" alt="Hero image history" class="h-28 w-full object-cover">
                                <div class="px-2 py-1 text-[11px] text-gray-500 bg-white flex items-center justify-between">
                                    <span>{{ $media->created_at->format('Y-m-d') }}</span>
                                    @if($media->is_active)
                                        <span class="font-semibold text-pink-600">Active</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No hero image history yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Past Hero Videos</h4>
                    <div class="space-y-3">
                        @forelse($heroVideoHistory as $media)
                            <div class="overflow-hidden rounded-xl border {{ $media->is_active ? 'border-pink-400 ring-1 ring-pink-300' : 'border-gray-200' }}">
                                <video src="{{ asset('storage/' . $media->media_path) }}" class="h-28 w-full object-cover" muted controls></video>
                                <div class="px-2 py-1 text-[11px] text-gray-500 bg-white flex items-center justify-between">
                                    <span>{{ $media->created_at->format('Y-m-d') }}</span>
                                    @if($media->is_active)
                                        <span class="font-semibold text-pink-600">Active</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No hero video history yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const HERO_LINK_OPTIONS = @json($allLinkOptions);

        function buildHeroLinkOptionsHtml() {
            return HERO_LINK_OPTIONS
                .map((opt) => `<option value="${opt.value}">${opt.label}</option>`)
                .join('');
        }

        function handleLinkChange(select) {
            const row = select.closest('.button-row');
            const hiddenInput = row.querySelector('.link-hidden');
            const customInput = row.querySelector('.custom-url-input');

            if (select.value === 'custom') {
                customInput.classList.remove('hidden');
                hiddenInput.value = customInput.value || '';
            } else {
                customInput.classList.add('hidden');
                hiddenInput.value = select.value;
            }
        }

        function reindexButtons() {
            document.querySelectorAll('#buttons-container .button-row').forEach((row, idx) => {
                row.querySelectorAll('[name]').forEach(el => {
                    el.name = el.name.replace(/buttons\[\d+\]/, `buttons[${idx}]`);
                });
            });
            updateAddBtn();
        }

        function updateAddBtn() {
            const count = document.querySelectorAll('#buttons-container .button-row').length;
            const btn = document.getElementById('add-button-btn');
            btn.disabled = count >= 4;
            btn.classList.toggle('opacity-40', count >= 4);
            btn.classList.toggle('cursor-not-allowed', count >= 4);
        }

        function addButtonRow() {
            const container = document.getElementById('buttons-container');
            const idx = container.querySelectorAll('.button-row').length;
            if (idx >= 4) return;

            const defaultLink = '/shop?title=Our Collection';
            const row = document.createElement('div');
            row.className = 'button-row flex flex-wrap items-end gap-3 p-4 rounded-xl border border-gray-200 bg-gray-50';
            row.innerHTML = `
                <input type="hidden" name="buttons[${idx}][link]" class="link-hidden" value="${defaultLink}">
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Label</label>
                    <input type="text" name="buttons[${idx}][label]" placeholder="e.g. Shop Now" maxlength="50" required
                           class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                </div>
                <div class="flex-1 min-w-[180px]">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Link</label>
                    <select class="link-select w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300"
                            onchange="handleLinkChange(this)">
                        ${buildHeroLinkOptionsHtml()}
                        <option value="custom">Custom URL</option>
                    </select>
                    <input type="text" placeholder="/custom-path"
                           oninput="this.closest('.button-row').querySelector('.link-hidden').value = this.value"
                           class="custom-url-input hidden mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                </div>
                <div class="flex items-end gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Button Color</label>
                        <input type="color" name="buttons[${idx}][bg_color]" value="#7c3aed"
                               class="h-9 w-14 cursor-pointer rounded-lg border border-gray-200 p-1">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Text Color</label>
                        <input type="color" name="buttons[${idx}][text_color]" value="#ffffff"
                               class="h-9 w-14 cursor-pointer rounded-lg border border-gray-200 p-1">
                    </div>
                    <button type="button" onclick="this.closest('.button-row').remove(); reindexButtons()"
                            class="h-9 px-3 rounded-lg border border-red-200 bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-100">
                        Remove
                    </button>
                </div>
            `;
            container.appendChild(row);
            updateAddBtn();
        }

        function reindexStores() {
            document.querySelectorAll('#stores-container .store-row').forEach((row, idx) => {
                row.querySelectorAll('[name]').forEach(el => {
                    el.name = el.name.replace(/stores\[\d+\]/, `stores[${idx}]`);
                });
            });
            updateAddStoreBtn();
        }

        function updateAddStoreBtn() {
            const count = document.querySelectorAll('#stores-container .store-row').length;
            const btn = document.getElementById('add-store-btn');
            if (!btn) return;
            btn.disabled = count >= 6;
            btn.classList.toggle('opacity-40', count >= 6);
            btn.classList.toggle('cursor-not-allowed', count >= 6);
        }

        function addStoreRow() {
            const container = document.getElementById('stores-container');
            const idx = container.querySelectorAll('.store-row').length;
            if (idx >= 6) return;

            const row = document.createElement('div');
            row.className = 'store-row rounded-xl border border-gray-200 bg-gray-50 p-4';
            row.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Store Name</label>
                        <input type="text" name="stores[${idx}][name]" maxlength="120" required
                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Address</label>
                        <input type="text" name="stores[${idx}][address]" maxlength="255" required
                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                        <input type="email" name="stores[${idx}][email]" maxlength="120"
                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Phone</label>
                        <input type="text" name="stores[${idx}][phone]" maxlength="60"
                               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 focus:border-purple-400 focus:outline-none focus:ring-1 focus:ring-purple-300">
                    </div>
                </div>
                <div class="mt-3 flex justify-end">
                    <button type="button" onclick="this.closest('.store-row').remove(); reindexStores()"
                            class="h-9 px-3 rounded-lg border border-red-200 bg-red-50 text-red-500 text-xs font-semibold hover:bg-red-100">
                        Remove
                    </button>
                </div>
            `;

            container.appendChild(row);
            updateAddStoreBtn();
        }

        updateAddBtn();
        updateAddStoreBtn();
    </script>
</x-app-layout>
