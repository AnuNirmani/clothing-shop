<?php

namespace App\Http\Controllers;

use App\Models\SiteMedia;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $homeHeroImage = SiteSetting::getValue('home_hero_image');
        $homeHeroVideo = SiteSetting::getValue('home_hero_video');

        $heroImageHistory = SiteMedia::where('media_type', 'image')
            ->latest()
            ->take(12)
            ->get();

        $heroVideoHistory = SiteMedia::where('media_type', 'video')
            ->latest()
            ->take(12)
            ->get();

        return view('site-settings.index', compact(
            'homeHeroImage',
            'homeHeroVideo',
            'heroImageHistory',
            'heroVideoHistory'
        ));
    }

    public function updateHeroMedia(Request $request)
    {
        $validated = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'hero_video' => 'nullable|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
        ]);

        if (!$request->hasFile('hero_image') && !$request->hasFile('hero_video')) {
            return redirect()
                ->route('site-settings.index')
                ->withErrors(['hero_image' => 'Please upload at least an image or a video.'])
                ->withInput();
        }

        SiteSetting::saveHeroMedia(
            $validated['hero_image'] ?? null,
            $validated['hero_video'] ?? null,
            auth()->id()
        );

        return redirect()
            ->route('site-settings.index')
            ->with('success', 'Site settings updated successfully!');
    }
}
