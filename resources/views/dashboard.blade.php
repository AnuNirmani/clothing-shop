<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Dashboard</span>
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-br from-pink-400 via-pink-500 to-blue-400 rounded-2xl shadow-xl p-8 mb-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                        <p class="text-pink-100 text-lg">{{ Auth::user()->email }}</p>
                        <p class="text-pink-100 mt-4">Manage your clothing inventory efficiently</p>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-32 opacity-50">
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-md p-6 border-2 border-pink-100 hover:border-pink-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Items</p>
                            <h4 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent mt-1">0</h4>
                        </div>
                        <div class="bg-gradient-to-br from-pink-100 to-blue-100 p-4 rounded-full shadow-md">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Low Stock</p>
                            <h4 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent mt-1">0</h4>
                        </div>
                        <div class="bg-gradient-to-br from-blue-100 to-pink-100 p-4 rounded-full shadow-md">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-2 border-pink-100 hover:border-pink-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Categories</p>
                            <h4 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent mt-1">0</h4>
                        </div>
                        <div class="bg-gradient-to-br from-pink-100 to-blue-100 p-4 rounded-full shadow-md">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6 border-2 border-pink-100">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('items.create') }}" class="flex items-center p-4 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 rounded-lg hover:from-pink-100 hover:to-blue-100 transition-all duration-200 border-2 border-pink-200 hover:border-pink-300 hover:shadow-md">
                        <div class="bg-gradient-to-br from-pink-400 to-pink-500 p-3 rounded-lg mr-4 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Add New Item</h4>
                            <p class="text-sm text-gray-600">Create a new product</p>
                        </div>
                    </a>

                    <a href="{{ route('items.index') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 via-pink-50 to-blue-50 rounded-lg hover:from-blue-100 hover:to-pink-100 transition-all duration-200 border-2 border-blue-200 hover:border-blue-300 hover:shadow-md">
                        <div class="bg-gradient-to-br from-blue-400 to-blue-500 p-3 rounded-lg mr-4 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">View All Items</h4>
                            <p class="text-sm text-gray-600">Browse inventory</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
