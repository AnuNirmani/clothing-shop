<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Items Management</span>
            </h2>
            <a href="{{ route('items.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-blue-500 hover:from-pink-600 hover:to-blue-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-pink-200/50 hover:shadow-pink-300/60 hover:scale-105 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Item
            </a>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .items-root { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.5s ease forwards; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.15s; }
        .delay-3 { animation-delay: 0.25s; }

        /* Row hover */
        .item-row { transition: all 0.2s ease; }
        .item-row:hover { background: linear-gradient(90deg, #fdf2f8, #f0f9ff); transform: translateX(2px); }

        /* Action buttons */
        .btn-action { transition: all 0.2s cubic-bezier(.34,1.56,.64,1); }
        .btn-action:hover { transform: translateY(-2px); }

        /* Stock badge glow */
        .stock-low  { box-shadow: 0 0 0 3px rgba(239,68,68,0.15); }
        .stock-good { box-shadow: 0 0 0 3px rgba(16,185,129,0.15); }

        /* Search bar focus */
        .search-input:focus { box-shadow: 0 0 0 3px rgba(236,72,153,0.2); }

        /* Scrollbar styling */
        .styled-scroll::-webkit-scrollbar { height: 4px; }
        .styled-scroll::-webkit-scrollbar-track { background: #fdf2f8; }
        .styled-scroll::-webkit-scrollbar-thumb { background: linear-gradient(90deg,#f9a8d4,#93c5fd); border-radius:9999px; }

        @keyframes fadeOutUp {
            from { opacity: 1; transform: translateY(0); }
            to   { opacity: 0; transform: translateY(-15px); }
        }

        .fade-out-up {
            animation: fadeOutUp 0.6s ease forwards;
        }

        @keyframes headerFloat {
            0%   { transform: translateY(15px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .header-animate {
            animation: headerFloat 0.8s cubic-bezier(.34,1.56,.64,1) forwards;
        }

        @keyframes glowPulse {
            0%   { opacity: 0.4; }
            50%  { opacity: 0.8; }
            100% { opacity: 0.4; }
        }

        .glow-bg {
            animation: glowPulse 6s ease-in-out infinite;
        }

    </style>

    <div class="items-root p-4 md:p-8" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 65px);">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- ── Success Alert ── --}}
            @if(session('success'))
            <div id="success-alert"
             class="fade-up delay-1 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl shadow-sm transition-all duration-700">
               <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            @endif

            {{-- ── Page Header Card ── --}}
            <div class="fade-up delay-1 relative bg-gradient-to-br from-[#130826] via-[#1e0d4a] to-[#0a1628] rounded-3xl p-6 md:p-8 overflow-hidden shadow-2xl">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-pink-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-10 left-1/3 w-48 h-48 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-5">
                    <div class="flex-1">
                        <p class="text-pink-300/70 text-[10px] font-bold uppercase tracking-[0.35em] mb-2">✦ Inventory</p>
                        <h1 class="font-display text-2xl md:text-3xl font-bold text-white mb-1">All Items</h1>
                        <p class="text-white/40 text-sm">{{ $items->total() }} products in your catalogue</p>
                    </div>
                    {{-- Search --}}
                    <div class="flex-shrink-0 w-full md:w-72">
                        <form method="GET" action="{{ route('items.index') }}">
                            <div class="relative">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Search items…"
                                       class="search-input w-full bg-white/10 border border-white/15 text-white placeholder-white/30 text-sm rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-pink-400/50 transition-all duration-200">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── Table Card ── --}}
            <div class="fade-up delay-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Table --}}
                <div class="styled-scroll overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background: linear-gradient(90deg,#fdf2f8,#f0f9ff,#fdf2f8);">
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Item</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Type</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Category</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Colors</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Price</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Stock</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Status</th>
                                <th class="px-6 py-4 text-center text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($items as $item)
                            <tr class="item-row">
                                {{-- Item name + image --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($item->image ?? false)
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                 class="w-11 h-11 rounded-xl object-cover shadow-sm ring-2 ring-gray-100 flex-shrink-0"
                                                 alt="{{ $item->name }}">
                                        @else
                                            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-pink-100 to-blue-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                                                <span class="font-display text-base font-bold text-pink-400">{{ strtoupper(substr($item->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 truncate max-w-[140px]">{{ $item->name }}</p>
                                            <p class="text-[11px] text-gray-400 truncate">{{ $item->SKU ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Type --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 text-pink-600 text-xs font-semibold ">
                                        {{ $item->type?->name ?? '—' }}
                                    </span>
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 text-blue-600 text-xs font-semibold">
                                        {{ $item->category?->name ?? '—' }}
                                    </span>
                                </td>

                                {{-- Colors --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1 flex-wrap">
                                        @forelse($item->colors->take(6) as $color)
                                            <span class="w-5 h-5 rounded-full border-2 border-white shadow-md ring-1 ring-gray-200"
                                                  title="{{ $color->name }}"
                                                  style="background-color: {{ $color->hex_code }}"></span>
                                        @empty
                                            <span class="text-xs text-gray-300">—</span>
                                        @endforelse
                                        @if($item->colors->count() > 6)
                                            <span class="text-[10px] text-gray-400 font-medium">+{{ $item->colors->count() - 6 }}</span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-800">Rs {{ number_format($item->prize, 2) }}</span>
                                </td>

                                {{-- Stock --}}
                                <td class="px-6 py-4">
                                    @php $stock = $item->stock_items; @endphp
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold
                                        {{ $stock == 0 ? 'bg-red-100 text-red-600 stock-low'
                                            : ($stock <= 5 ? 'bg-amber-100 text-amber-600'
                                            : 'bg-emerald-100 text-emerald-600 stock-good') }}">
                                        @if($stock == 0)
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                        @elseif($stock <= 5)
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                        @else
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        @endif
                                        {{ $stock }}
                                    </span>
                                </td>

                                {{-- Availability --}}
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold
                                            {{ $item->availability ? 'text-emerald-700' : 'text-red-600' }}">
                                            {{ $item->availability ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('items.edit', $item->id) }}"
                                           class="btn-action inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 text-amber-600 rounded-lg border border-amber-200 hover:bg-amber-100 hover:border-amber-400 hover:shadow-md text-xs font-semibold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>

                                        {{-- View --}}
                                        <a href="{{ route('items.show', $item->id) }}"
                                           class="btn-action inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-100 hover:border-blue-400 hover:shadow-md text-xs font-semibold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Delete {{ addslashes($item->name) }}? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-action inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-600 rounded-lg border border-red-200 hover:bg-red-100 hover:border-red-400 hover:shadow-md text-xs font-semibold">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-100 to-blue-100 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-display text-xl font-semibold text-gray-500 mb-1">No items found</p>
                                            <p class="text-gray-400 text-sm">Your inventory is empty. Add your first product!</p>
                                        </div>
                                        <a href="{{ route('items.create') }}"
                                           class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-blue-500 text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg hover:shadow-pink-200/60 hover:scale-105 transition-all duration-200 text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Add First Item
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ── Pagination ── --}}
                @if($items->total() > 0)
                <div class="fade-up delay-3 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4"
                     style="background: linear-gradient(90deg,#fdf2f8,#f0f9ff,#fdf2f8); border-top: 1px solid #fce7f3;">
                    <p class="text-sm text-gray-500">
                        Showing
                        <span class="font-bold text-pink-500">{{ $items->firstItem() ?? 0 }}</span>–<span class="font-bold text-pink-500">{{ $items->lastItem() ?? 0 }}</span>
                        of
                        <span class="font-bold text-blue-500">{{ $items->total() }}</span> items
                    </p>
                    <div class="flex items-center gap-1.5">
                        {{-- Prev --}}
                        @if($items->onFirstPage())
                            <span class="px-3 py-2 text-xs text-gray-300 bg-white border border-gray-100 rounded-lg cursor-not-allowed">← Prev</span>
                        @else
                            <a href="{{ $items->previousPageUrl() }}"
                               class="px-3 py-2 text-xs font-semibold text-gray-600 bg-white border border-pink-200 rounded-lg hover:bg-pink-50 hover:border-pink-400 transition-all duration-150">← Prev</a>
                        @endif

                        {{-- Page numbers --}}
                        @foreach($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                            @if($page == $items->currentPage())
                                <span class="px-3.5 py-2 text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-blue-500 rounded-lg shadow-md shadow-pink-200/50">{{ $page }}</span>
                            @elseif(abs($page - $items->currentPage()) <= 2)
                                <a href="{{ $url }}"
                                   class="px-3.5 py-2 text-xs font-semibold text-gray-600 bg-white border border-gray-100 rounded-lg hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 hover:border-pink-300 transition-all duration-150">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($items->hasMorePages())
                            <a href="{{ $items->nextPageUrl() }}"
                               class="px-3 py-2 text-xs font-semibold text-gray-600 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 hover:border-blue-400 transition-all duration-150">Next →</a>
                        @else
                            <span class="px-3 py-2 text-xs text-gray-300 bg-white border border-gray-100 rounded-lg cursor-not-allowed">Next →</span>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.add('fade-out-up');
                    setTimeout(() => {
                        alertBox.remove();
                    }, 600);
                }, 10000); // 10 seconds
            }
        });
    </script>

</x-app-layout>