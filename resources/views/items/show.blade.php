<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Item Details</span>
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('items.edit', $item->id) }}" class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-white font-semibold shadow-md bg-gradient-to-r from-pink-500 to-blue-500 hover:from-pink-600 hover:to-blue-600 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Edit Item</span>
                </a>
                <a href="{{ route('items.index') }}" class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 border border-gray-200 bg-white text-gray-700 font-semibold hover:bg-gray-50 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Back to List</span>
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        .show-root { background: linear-gradient(135deg, #fdf2f8 0%, #eef2ff 50%, #f0f9ff 100%); min-height: calc(100vh - 64px); }
        .show-card { border-radius: 20px; border: 1px solid #f3e8ff; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(6px); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05); }
        .field-label { font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: #6b7280; margin-bottom: 6px; }
        .field-value { border-radius: 12px; border: 1px solid #f1f5f9; background: #f8fafc; padding: 10px 12px; color: #334155; font-weight: 600; }
        .section-title { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; font-size: 18px; font-weight: 700; color: #1f2937; }
        .pill { display: inline-flex; align-items: center; gap: 6px; border-radius: 9999px; border: 1px solid #dbeafe; background: #eff6ff; color: #1e40af; padding: 4px 10px; font-size: 12px; font-weight: 700; }
        .hero { border-radius: 24px; padding: 20px; background: linear-gradient(135deg, #130826 0%, #21114d 55%, #0f1e3a 100%); box-shadow: 0 16px 42px rgba(19, 8, 38, 0.35); }
    </style>

    <div class="show-root py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="hero">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold tracking-[0.25em] uppercase text-pink-300/80 mb-1">Inventory</p>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $item->name }}</h1>
                        <p class="text-white/60 text-sm mt-1">SKU: {{ $item->SKU }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold {{ $item->availability ? 'bg-emerald-400/20 text-emerald-200 border border-emerald-300/30' : 'bg-red-400/20 text-red-100 border border-red-300/30' }}">
                            {{ $item->availability ? 'In Stock' : 'Out of Stock' }}
                        </span>
                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white/10 text-white border border-white/20">{{ $item->stock_items }} units</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="show-card p-6">
                        <h3 class="section-title">
                            <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0"/></svg>
                            Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><p class="field-label">Name</p><div class="field-value">{{ $item->name }}</div></div>
                            <div><p class="field-label">Co Name</p><div class="field-value">{{ $item->co_name ?? 'NULL' }}</div></div>
                            <div><p class="field-label">SKU</p><div class="field-value font-mono">{{ $item->SKU }}</div></div>
                            <div><p class="field-label">Stock Quantity</p><div class="field-value">{{ $item->stock_items }} units</div></div>
                        </div>

                        @if($item->description)
                        <div class="mt-4">
                            <p class="field-label">Description</p>
                            <div class="field-value whitespace-pre-wrap min-h-[72px]">{{ $item->description }}</div>
                        </div>
                        @endif

                        @if($item->note)
                        <div class="mt-4">
                            <p class="field-label">Note</p>
                            <div class="field-value whitespace-pre-wrap min-h-[72px]">{{ $item->note }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="show-card p-6">
                        <h3 class="section-title">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            Selections
                        </h3>

                        @php
                            $classificationList = $item->classifications ?? collect();
                            $colorList = $item->colors ?? collect();
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><p class="field-label">Category</p><div class="field-value">{{ $item->category?->name ?? 'NULL' }}</div></div>
                            <div><p class="field-label">Type</p><div class="field-value">{{ $item->type?->name ?? 'NULL' }}</div></div>

                            <div>
                                <p class="field-label">Classification</p>
                                <div class="field-value">
                                    @if($classificationList->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($classificationList as $classification)
                                                <span class="pill">{{ $classification->name }}</span>
                                            @endforeach
                                        </div>
                                    @elseif($item->classification)
                                        {{ $item->classification->name }}
                                    @else
                                        NULL
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="field-label">Color</p>
                                <div class="field-value">
                                    @if($colorList->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($colorList as $color)
                                                <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-2 py-1 text-xs font-semibold text-slate-700">
                                                    <span class="w-3.5 h-3.5 rounded-full border border-slate-300" style="background-color: {{ $color->hex_code ?? '#CCCCCC' }}"></span>
                                                    {{ $color->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @elseif($item->color)
                                        {{ $item->color->name }}
                                    @else
                                        NULL
                                    @endif
                                </div>
                            </div>

                            <div><p class="field-label">Material</p><div class="field-value">{{ $item->material?->name ?? 'NULL' }}</div></div>
                            <div>
                                <p class="field-label">Size</p>
                                <div class="field-value">
                                    <div class="flex flex-wrap gap-2">
                                        @if(!empty($item->size_label))
                                            <span class="inline-flex items-center rounded-lg border border-pink-300 bg-pink-50 px-2.5 py-1 text-xs font-bold text-pink-700">{{ strtoupper($item->size_label) }}</span>
                                        @endif
                                        @if($item->size)
                                            <span class="inline-flex items-center rounded-lg border border-blue-300 bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">{{ $item->size->name }}</span>
                                        @endif
                                        @if(empty($item->size_label) && !$item->size)
                                            NULL
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show-card p-6">
                        <h3 class="section-title">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Product Images
                        </h3>

                        <div class="mb-5">
                            <p class="field-label">Main Image</p>
                            @if($item->image)
                                <img id="main-image" src="{{ Storage::url($item->image) }}?v={{ $item->updated_at?->timestamp ?? time() }}" alt="{{ $item->name }}" class="w-full h-96 object-cover rounded-2xl border border-purple-200">
                            @else
                                <div class="rounded-2xl border border-dashed border-purple-200 bg-purple-50 px-6 py-14 text-center text-purple-400 font-semibold">No main image available</div>
                            @endif
                        </div>

                        <div>
                            <p class="field-label">Additional Photos</p>
                            @if($item->photos && $item->photos->count() > 0)
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @foreach($item->photos as $photo)
                                        <button type="button" class="relative group" onclick="changeMainImage('{{ Storage::url($photo->photo_path) }}?v={{ $item->updated_at?->timestamp ?? time() }}')">
                                            <img src="{{ Storage::url($photo->photo_path) }}?v={{ $item->updated_at?->timestamp ?? time() }}" alt="Product photo" class="w-full h-28 object-cover rounded-xl border border-purple-200 group-hover:border-purple-400 transition-all">
                                        </button>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-xl border border-dashed border-purple-200 bg-purple-50 px-4 py-8 text-center text-purple-400 font-medium">No additional photos available</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="show-card p-6">
                        <h3 class="section-title">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Pricing
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <p class="field-label">Price</p>
                                <div class="field-value text-green-700 text-lg">Rs {{ number_format($item->prize, 2) }}</div>
                            </div>
                            <div>
                                <p class="field-label">Installment (3 Months)</p>
                                <div class="field-value">Rs {{ number_format(($item->discounted_price ?? $item->prize) / 3, 2) }}</div>
                            </div>
                            <div>
                                <p class="field-label">Installment (4 Months)</p>
                                <div class="field-value">Rs {{ number_format(($item->discounted_price ?? $item->prize) / 4, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="show-card p-6">
                        <h3 class="section-title">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Availability & Offers
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <p class="field-label">Status</p>
                                <div class="w-full rounded-xl border px-3 py-2 text-center font-bold {{ $item->availability ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-red-200 bg-red-50 text-red-700' }}">
                                    {{ $item->availability ? 'In Stock' : 'Out of Stock' }}
                                </div>
                            </div>

                            @if($item->is_gift_card)
                            <div class="rounded-xl border border-pink-200 bg-pink-50 p-3">
                                <p class="text-xs font-bold uppercase tracking-wider text-pink-700 mb-1">Gift Card</p>
                                <p class="text-sm text-slate-700">Validity: <span class="font-bold">{{ $item->gift_card_validity_months }} {{ $item->gift_card_validity_months == 1 ? 'Month' : 'Months' }}</span></p>
                            </div>
                            @endif

                            @if($item->is_on_offer)
                            <div class="rounded-xl border border-green-200 bg-green-50 p-3 space-y-2">
                                <p class="text-xs font-bold uppercase tracking-wider text-green-700">Offer Active</p>
                                <p class="text-sm text-slate-700">Discount: <span class="font-bold">{{ number_format($item->offer_percentage, 2) }}%</span></p>
                                <p class="text-sm text-slate-700">Period: <span class="font-semibold">{{ \Carbon\Carbon::parse($item->offer_start_date)->format('M d, Y') }}</span> - <span class="font-semibold">{{ \Carbon\Carbon::parse($item->offer_end_date)->format('M d, Y') }}</span></p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="show-card p-6">
                        <h3 class="section-title">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Inventory Value
                        </h3>
                        <div class="rounded-xl border border-purple-200 bg-gradient-to-br from-purple-50 to-pink-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wider text-purple-600 mb-1">Total Stock Value</p>
                            <p class="text-3xl font-bold text-purple-700">Rs {{ number_format($item->prize * $item->stock_items, 2) }}</p>
                            <p class="text-xs text-slate-500 mt-2">{{ $item->stock_items }} units x Rs {{ number_format($item->prize, 2) }}</p>
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
                mainImage.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    </script>
</x-app-layout>
