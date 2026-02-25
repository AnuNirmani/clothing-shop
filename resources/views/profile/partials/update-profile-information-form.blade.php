<section>
    <header class="mb-8 relative">
        <div class="absolute -left-8 top-0 bottom-0 w-1 bg-gradient-to-b from-pink-500 to-blue-500 rounded-r-full"></div>
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-gray-600">
            {{ __("View your account's profile information and email address.") }}
        </p>
    </header>

    <div class="space-y-6">
        <div class="group">
            <label class="block font-bold text-sm text-gray-700 mb-2 group-hover:text-pink-500 transition-colors">{{ __('Name') }}</label>
            <div class="w-full px-5 py-4 border-2 border-pink-50 rounded-xl bg-pink-50/30 text-gray-800 font-medium shadow-sm group-hover:border-pink-200 transition-all duration-300">
                {{ $user->name }}
            </div>
        </div>

        <div class="group">
            <label class="block font-bold text-sm text-gray-700 mb-2 group-hover:text-blue-500 transition-colors">{{ __('Email') }}</label>
            <div class="w-full px-5 py-4 border-2 border-blue-50 rounded-xl bg-blue-50/30 text-gray-800 font-medium shadow-sm group-hover:border-blue-200 transition-all duration-300">
                {{ $user->email }}
            </div>
        </div>
    </div>
</section>
