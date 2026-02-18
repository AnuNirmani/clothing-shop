<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gradient-to-r from-pink-500 via-blue-600 to-pink-600 bg-clip-text text-transparent leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md shadow-2xl rounded-3xl border border-pink-100 overflow-hidden">
                <div class="p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
