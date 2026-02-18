<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Create New User
            </span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

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

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="space-y-6">

                    <!-- User Details Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-pink-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            User Information
                        </h3>

                        <div class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block font-semibold mb-2 text-gray-700">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                >
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block font-semibold mb-2 text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="username"
                                    class="w-full rounded-lg border-pink-200 focus:ring-pink-300 focus:border-pink-400"
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Password Card -->
                    <div class="bg-white shadow-lg rounded-2xl border border-blue-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Set Password
                        </h3>

                        <div class="space-y-4">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block font-semibold mb-2 text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400"
                                >
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block font-semibold mb-2 text-gray-700">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    class="w-full rounded-lg border-blue-200 focus:ring-blue-300 focus:border-blue-400"
                                >
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                        <div class="space-y-3">
                            <button type="submit"
                                class="w-full px-6 py-4 bg-gradient-to-r from-pink-500 to-blue-500 
                                       hover:from-pink-600 hover:to-blue-600 
                                       text-white rounded-xl font-bold shadow-lg 
                                       hover:scale-105 transition-all duration-200
                                       flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Create User
                            </button>

                            <a href="{{ route('users.index') }}"
                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl text-gray-700 
                                       hover:bg-white hover:border-gray-400 hover:scale-105 
                                       transition-all duration-200 font-semibold
                                       flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>