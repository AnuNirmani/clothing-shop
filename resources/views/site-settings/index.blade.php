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
</x-app-layout>
