<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-pink-50 via-white to-blue-50">
            @include('layouts.navigation')

            <div class="flex">
                <!-- Sidebar -->
                <aside class="w-64 bg-white shadow-lg min-h-screen border-r border-pink-100">
                    <nav class="mt-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('items.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('items.*') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('items.*') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Items
                        </a>
                        <a href="{{ route('types.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('types.*') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('types.*') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Types
                        </a>
                        <a href="{{ route('categories.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('categories.*') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('categories.*') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Categories
                        </a>
                        <a href="{{ route('classifications.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('classifications.*') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('classifications.*') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Classifications
                        </a>
                        <a href="{{ route('colors.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('colors.*') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('colors.*') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            Colors
                        </a>
                        <a href="{{ route('materials.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('materials.*') ? 'bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-l-4 border-pink-400 text-pink-700 font-semibold' : 'hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50 transition-all duration-200' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('materials.*') ? 'text-pink-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Materials
                        </a>
                    </nav>
                </aside>

                <!-- Main Content -->
                <div class="flex-1">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow-sm border-b border-pink-100">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
