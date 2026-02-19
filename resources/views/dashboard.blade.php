<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Dashboard</span>
        </h2>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .dash-root { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        @keyframes borderSpin {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-border {
            background: linear-gradient(270deg, #f9a8d4, #93c5fd, #f472b6, #818cf8, #f9a8d4);
            background-size: 400% 400%;
            animation: borderSpin 6s ease infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }
        .float-logo { animation: float 4s ease-in-out infinite; }

        @keyframes shimmer {
            0%   { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(300%) skewX(-15deg); }
        }
        .shimmer-wrap { position: relative; overflow: hidden; }
        .shimmer-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
            animation: shimmer 4s infinite;
            pointer-events: none;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.6s ease forwards; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.15s; }
        .delay-3 { animation-delay: 0.25s; }
        .delay-4 { animation-delay: 0.35s; }
        .delay-5 { animation-delay: 0.45s; }
        .delay-6 { animation-delay: 0.55s; }

        .stat-card { transition: transform 0.3s cubic-bezier(.34,1.56,.64,1), box-shadow 0.3s ease; }
        .stat-card:hover { transform: translateY(-6px) scale(1.02); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }

        @keyframes fillBar {
            from { width: 0%; }
            to   { width: var(--target-width); }
        }
        .bar-fill {
            animation: fillBar 1.4s cubic-bezier(.4,0,.2,1) forwards;
            animation-delay: 0.9s;
            width: 0%;
        }

        .action-link { transition: all 0.25s cubic-bezier(.4,0,.2,1); }
        .action-link:hover { transform: translateX(5px); }

        @keyframes alertPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(251,146,60,0.45); }
            50%       { box-shadow: 0 0 0 8px rgba(251,146,60,0); }
        }
        .alert-pulse { animation: alertPulse 2.2s infinite; }
    </style>

    <div class="dash-root p-4 md:p-8" style="background: linear-gradient(135deg, #fdf2f8 0%, #f0f9ff 55%, #fdf4ff 100%); min-height: calc(100vh - 65px);">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- ══════════ HERO WELCOME CARD ══════════ --}}
            <div class="fade-up delay-1 animated-border p-[3px] rounded-3xl shadow-2xl">
                <div class="shimmer-wrap bg-gradient-to-br from-[#130826] via-[#1e0d4a] to-[#0a1628] rounded-[22px] p-8 md:p-12 relative overflow-hidden">

                    {{-- Background orbs --}}
                    <div class="absolute -top-20 -right-20 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-16 left-1/4 w-72 h-72 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute top-1/3 -left-16 w-56 h-56 bg-purple-400/10 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8 md:gap-12">

                        {{-- Floating Logo --}}
                        <div class="float-logo flex-shrink-0">
                            <div class="animated-border p-[3px] rounded-2xl shadow-2xl w-28 h-28 md:w-36 md:h-36">
                                <div class="w-full h-full rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                         class="w-full h-full object-contain p-3 drop-shadow-lg">
                                </div>
                            </div>
                        </div>

                        {{-- Text block --}}
                        <div class="text-center md:text-left flex-1">
                            <p class="text-pink-300/80 text-xs font-semibold tracking-[0.35em] uppercase mb-3">
                                ✦ Inventory Management
                            </p>
                            <h3 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                                Welcome back,<br>
                                <span class="bg-gradient-to-r from-pink-300 via-purple-300 to-blue-300 bg-clip-text text-transparent">
                                    {{ Auth::user()->name }}
                                </span>
                            </h3>
                            <p class="text-white/40 text-sm mb-1">{{ Auth::user()->email }}</p>
                            <p class="text-white/25 text-xs tracking-widest">{{ now()->format('l · d F Y · H:i') }}</p>
                            <div class="mt-6 inline-flex items-center gap-2.5 bg-white/8 backdrop-blur border border-white/15 rounded-full px-5 py-2.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
                                <span class="text-white/60 text-xs font-medium">Manage your clothing inventory efficiently ✨</span>
                            </div>
                        </div>

                        {{-- Date badge --}}
                        <div class="hidden lg:flex flex-col items-center justify-center bg-white/5 border border-white/10 rounded-2xl px-7 py-6 text-center flex-shrink-0 backdrop-blur-sm">
                            <p class="text-pink-300/70 text-[10px] uppercase tracking-[0.3em] font-semibold">Today</p>
                            <p class="font-display text-5xl font-bold text-white mt-1 leading-none">{{ now()->format('d') }}</p>
                            <p class="text-white/40 text-sm mt-1">{{ now()->format('M Y') }}</p>
                            <div class="mt-3 w-8 h-[2px] bg-gradient-to-r from-pink-400 to-blue-400 rounded-full"></div>
                            <p class="text-white/30 text-xs mt-2">{{ now()->format('D') }}</p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ══════════ STAT CARDS ══════════ --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

                {{-- Total Items --}}
                <div class="fade-up delay-2 stat-card bg-white rounded-2xl p-6 border border-pink-100/80 shadow-sm relative overflow-hidden group cursor-default">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-50/80 to-rose-50/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-pink-100/50 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg shadow-pink-200/60 mb-5">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.2em]">Total Items</p>
                        <h4 class="font-display text-4xl font-bold text-gray-800 mt-1">{{ $totalItems }}</h4>
                        <p class="text-xs text-pink-400 mt-2 font-medium">in inventory</p>
                    </div>
                </div>

                {{-- Low Stock --}}
                <div class="fade-up delay-2 stat-card bg-white rounded-2xl p-6 border border-amber-100/80 shadow-sm relative overflow-hidden group cursor-default">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-50/80 to-orange-50/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-amber-100/50 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-200/60 mb-5">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.2em]">Low Stock</p>
                        <h4 class="font-display text-4xl font-bold text-gray-800 mt-1">{{ $lowStockItems }}</h4>
                        <p class="text-xs text-amber-500 mt-2 font-medium">minimum than 5 units</p>
                    </div>
                </div>

                {{-- Categories --}}
                <div class="fade-up delay-3 stat-card bg-white rounded-2xl p-6 border border-blue-100/80 shadow-sm relative overflow-hidden group cursor-default">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/80 to-indigo-50/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-100/50 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200/60 mb-5">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.2em]">Categories</p>
                        <h4 class="font-display text-4xl font-bold text-gray-800 mt-1">{{ $categoriesCount }}</h4>
                        <p class="text-xs text-blue-400 mt-2 font-medium">product groups</p>
                    </div>
                </div>

                {{-- Out of Stock --}}
                <div class="fade-up delay-3 stat-card bg-white rounded-2xl p-6 border border-red-100/80 shadow-sm relative overflow-hidden group cursor-default">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-50/80 to-pink-50/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-red-100/50 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg shadow-red-200/60 mb-5">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-[0.2em]">Out of Stock</p>
                        <h4 class="font-display text-4xl font-bold text-gray-800 mt-1">{{ $outOfStock }}</h4>
                        <p class="text-xs text-red-400 mt-2 font-medium">need restocking</p>
                    </div>
                </div>
            </div>

            {{-- ══════════ BOTTOM 3-COL GRID ══════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ── Quick Actions ── --}}
                <div class="fade-up delay-4 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 pt-6 pb-4 border-b border-gray-50/80">
                        <p class="text-[10px] font-bold text-pink-400 uppercase tracking-[0.3em] mb-1">Shortcuts</p>
                        <h3 class="font-display text-xl font-semibold text-gray-800">Quick Actions</h3>
                    </div>
                    <div class="p-5 space-y-3">

                        <a href="{{ route('items.create') }}" class="action-link flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-pink-50 to-rose-50/60 hover:from-pink-100 hover:to-rose-100 border border-pink-100 hover:border-pink-300 hover:shadow-md group">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-rose-500 rounded-xl flex items-center justify-center shadow-md flex-shrink-0 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 text-sm">Add New Item</p>
                                <p class="text-xs text-gray-400">Create a new product listing</p>
                            </div>
                            <svg class="w-4 h-4 text-pink-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('items.index') }}" class="action-link flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50/60 hover:from-blue-100 hover:to-indigo-100 border border-blue-100 hover:border-blue-300 hover:shadow-md group">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-md flex-shrink-0 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 text-sm">View All Items</p>
                                <p class="text-xs text-gray-400">Browse full inventory</p>
                            </div>
                            <svg class="w-4 h-4 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('categories.index') }}" class="action-link flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-purple-50 to-fuchsia-50/60 hover:from-purple-100 hover:to-fuchsia-100 border border-purple-100 hover:border-purple-300 hover:shadow-md group">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-fuchsia-500 rounded-xl flex items-center justify-center shadow-md flex-shrink-0 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 text-sm">Manage Categories</p>
                                <p class="text-xs text-gray-400">Organise product groups</p>
                            </div>
                            <svg class="w-4 h-4 text-purple-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        @if($lowStockItems > 0)
                        <a href="{{ route('items.index') }}" class="alert-pulse action-link flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-amber-50 to-orange-50/60 hover:from-amber-100 hover:to-orange-100 border border-amber-200 hover:border-amber-400 hover:shadow-md group">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center shadow-md flex-shrink-0 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 text-sm">⚠ Low Stock Alert</p>
                                <p class="text-xs text-orange-500 font-semibold">{{ $lowStockItems }} items need restocking</p>
                            </div>
                        </a>
                        @endif

                    </div>
                </div>

                {{-- ── Recently Added ── --}}
                <div class="fade-up delay-5 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 pt-6 pb-4 border-b border-gray-50/80 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.3em] mb-1">Latest</p>
                            <h3 class="font-display text-xl font-semibold text-gray-800">Recently Added</h3>
                        </div>
                        <a href="{{ route('items.index') }}" class="text-xs text-blue-400 hover:text-blue-600 font-semibold transition-colors">View all →</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentItems as $item)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50/60 transition-colors duration-150">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($item->image ?? false)
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         class="w-11 h-11 rounded-xl object-cover flex-shrink-0 shadow-sm ring-2 ring-gray-100"
                                         alt="{{ $item->name }}">
                                @else
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-pink-100 to-blue-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                                        <span class="font-display text-base font-bold text-pink-500">
                                            {{ strtoupper(substr($item->name ?? 'I', 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-700 truncate">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ $item->category->name ?? 'Uncategorized' }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-0.5 ml-3 flex-shrink-0">
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full
                                    {{ $item->availability === 'out of stock'
                                        ? 'bg-red-100 text-red-500'
                                        : ($item->stock_items <= 5
                                            ? 'bg-amber-100 text-amber-600'
                                            : 'bg-emerald-100 text-emerald-600') }}">
                                    {{ $item->stock_items }}
                                </span>
                                <span class="text-[10px] text-gray-300 font-medium">units</span>
                            </div>
                        </div>
                        @empty
                        <div class="flex flex-col items-center justify-center py-14 text-gray-300">
                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-sm font-medium">No items yet</p>
                            <a href="{{ route('items.create') }}" class="mt-3 text-xs text-pink-400 hover:text-pink-600 font-semibold transition-colors">+ Add your first item</a>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- ── Top Categories ── --}}
                <div class="fade-up delay-6 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 pt-6 pb-4 border-b border-gray-50/80">
                        <p class="text-[10px] font-bold text-purple-400 uppercase tracking-[0.3em] mb-1">Breakdown</p>
                        <h3 class="font-display text-xl font-semibold text-gray-800">Top Categories</h3>
                    </div>
                    <div class="p-6 space-y-5">
                        @php
                            $barPalette = [
                                ['from-pink-400 to-rose-500',     'bg-pink-500',    'text-pink-500',    'bg-pink-50'],
                                ['from-blue-400 to-indigo-500',   'bg-blue-500',    'text-blue-500',    'bg-blue-50'],
                                ['from-purple-400 to-fuchsia-500','bg-purple-500',  'text-purple-500',  'bg-purple-50'],
                                ['from-emerald-400 to-teal-500',  'bg-emerald-500', 'text-emerald-500', 'bg-emerald-50'],
                                ['from-amber-400 to-orange-500',  'bg-amber-500',   'text-amber-500',   'bg-amber-50'],
                            ];
                            $maxCount = $topCategories->max('items_count') ?: 1;
                        @endphp
                        @forelse($topCategories as $cat)
                        @php
                            $p   = $barPalette[$loop->index % count($barPalette)];
                            $pct = round(($cat->items_count / $maxCount) * 100);
                        @endphp
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-br {{ $p[0] }} shadow-sm flex-shrink-0"></div>
                                    <span class="text-sm font-semibold text-gray-700">{{ $cat->name ?? 'Uncategorized' }}</span>
                                </div>
                                <span class="text-xs font-bold {{ $p[2] }} {{ $p[3] }} px-2.5 py-0.5 rounded-full">
                                    {{ $cat->items_count }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="bar-fill h-2 rounded-full bg-gradient-to-r {{ $p[0] }}"
                                     style="--target-width: {{ $pct }}%"></div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10">
                            <p class="text-sm text-gray-300 font-medium">No categories found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>