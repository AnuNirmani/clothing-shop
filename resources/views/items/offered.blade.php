<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Offered Items</span>
        </h2>
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

        .item-row { transition: all 0.2s ease; }
        .item-row:hover { background: linear-gradient(90deg, #fdf2f8, #f0f9ff); transform: translateX(2px); }

        .btn-action { transition: all 0.2s cubic-bezier(.34,1.56,.64,1); }
        .btn-action:hover { transform: translateY(-2px); }
    </style>

    <div class="items-root p-4 md:p-8" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 65px);">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="fade-up delay-1 relative bg-gradient-to-br from-[#130826] via-[#1e0d4a] to-[#0a1628] rounded-3xl p-6 md:p-8 overflow-hidden shadow-2xl">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-pink-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-10 left-1/3 w-48 h-48 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-5">
                    <div class="flex-1">
                        <p class="text-pink-300/70 text-[10px] font-bold uppercase tracking-[0.35em] mb-2">✦ Offers</p>
                        <h1 class="font-display text-2xl md:text-3xl font-bold text-white mb-1">All Offered Items</h1>
                        <p class="text-white/40 text-sm">{{ $items->total() }} items currently on offer</p>
                    </div>
                    <div class="flex-shrink-0 w-full md:w-72">
                        <form method="GET" action="{{ route('offered-items.index') }}">
                            <div class="relative">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Search offered items…"
                                       class="w-full bg-white/10 border border-white/15 text-white placeholder-white/30 text-sm rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-pink-400/50 transition-all duration-200">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="fade-up delay-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background: linear-gradient(90deg,#fdf2f8,#f0f9ff,#fdf2f8);">
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Item</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Type</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Category</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Offer %</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Price</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-blue-500 uppercase tracking-[0.15em]">Offer Period</th>
                                <th class="px-6 py-4 text-center text-[11px] font-bold text-pink-500 uppercase tracking-[0.15em]">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($items as $item)
                                <tr class="item-row">
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
                                                <p class="text-sm font-semibold text-gray-800 truncate max-w-[180px]">{{ $item->name }}</p>
                                                <p class="text-[11px] text-gray-400 truncate">{{ $item->SKU ?? '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->type?->name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->category?->name ?? '—' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            {{ rtrim(rtrim(number_format($item->offer_percentage ?? 0, 2, '.', ''), '0'), '.') }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm">
                                            <p class="font-bold text-gray-800">Rs {{ number_format($item->discounted_price ?? $item->prize, 2) }}</p>
                                            <p class="text-xs text-gray-400 line-through">Rs {{ number_format($item->prize, 2) }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        @php
                                            $start = $item->offer_start_date ? \Carbon\Carbon::parse($item->offer_start_date) : null;
                                            $end = $item->offer_end_date ? \Carbon\Carbon::parse($item->offer_end_date) : null;
                                            $periodDays = ($start && $end) ? $start->diffInDays($end) + 1 : null;
                                        @endphp

                                        @if($start && $end)
                                            <p class="font-semibold text-gray-800">{{ $start->format('M d, Y') }} <span class="text-gray-400">→</span> {{ $end->format('M d, Y') }}</p>
                                            <p class="text-xs text-blue-500 font-semibold">{{ $periodDays }} day period</p>
                                        @else
                                            <span>—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <a href="{{ route('items.show', $item->id) }}"
                                               class="btn-action inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-100 hover:border-blue-400 hover:shadow-md text-xs font-semibold">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-pink-100 to-blue-100 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                            <p class="font-display text-xl font-semibold text-gray-500">No offered items found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($items->total() > 0)
                    <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4"
                         style="background: linear-gradient(90deg,#fdf2f8,#f0f9ff,#fdf2f8); border-top: 1px solid #fce7f3;">
                        <p class="text-sm text-gray-500">
                            Showing
                            <span class="font-bold text-pink-500">{{ $items->firstItem() ?? 0 }}</span>–<span class="font-bold text-pink-500">{{ $items->lastItem() ?? 0 }}</span>
                            of
                            <span class="font-bold text-blue-500">{{ $items->total() }}</span> offered items
                        </p>
                        <div>
                            {{ $items->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
