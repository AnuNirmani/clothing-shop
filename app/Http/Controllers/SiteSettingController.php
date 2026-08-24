<?php

namespace App\Http\Controllers;

use App\Models\SiteMedia;
use App\Models\OfferCategory;
use App\Models\SiteSetting;
use App\Models\StoreLocation;
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

        $heroButtons = SiteSetting::getHeroButtons();
        $stores = SiteSetting::getStores();
        $bankAccounts = SiteSetting::getBankAccounts();
        $offerCategories = OfferCategory::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('site-settings.index', compact(
            'homeHeroImage',
            'homeHeroVideo',
            'heroImageHistory',
            'heroVideoHistory',
            'heroButtons',
            'stores',
            'bankAccounts',
            'offerCategories'
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

    public function updateHeroButtons(Request $request)
    {
        $validated = $request->validate([
            'buttons'                 => 'nullable|array|max:4',
            'buttons.*.label'         => 'required|string|max:50',
            'buttons.*.link'          => 'required|string|max:255',
            'buttons.*.bg_color'      => ['required', 'regex:/^#[0-9a-fA-F]{3,8}$/'],
            'buttons.*.text_color'    => ['required', 'regex:/^#[0-9a-fA-F]{3,8}$/'],
        ]);

        SiteSetting::saveHeroButtons($validated['buttons'] ?? []);

        return redirect()
            ->route('site-settings.index')
            ->with('buttons_success', 'Hero buttons updated successfully!');
    }

    public function updateStores(Request $request)
    {
        $validated = $request->validate([
            'stores' => 'nullable|array|max:6',
            'stores.*.id' => 'nullable|integer|exists:store_locations,id',
            'stores.*.name' => 'required|string|max:120',
            'stores.*.address' => 'required|string|max:255',
            'stores.*.email' => 'nullable|email|max:120',
            'stores.*.phone' => 'nullable|string|max:60',
        ]);

        $storeData = $validated['stores'] ?? [];

        // Delete stores that aren't in the update
        $storeIds = collect($storeData)->pluck('id')->filter()->toArray();
        StoreLocation::whereNotIn('id', $storeIds)->delete();

        // Create or update stores
        foreach ($storeData as $index => $store) {
            if (isset($store['id']) && $store['id']) {
                StoreLocation::where('id', $store['id'])->update([
                    'name' => $store['name'],
                    'address' => $store['address'],
                    'email' => $store['email'],
                    'phone' => $store['phone'],
                    'display_order' => $index,
                ]);
            } else {
                StoreLocation::create([
                    'name' => $store['name'],
                    'address' => $store['address'],
                    'email' => $store['email'],
                    'phone' => $store['phone'],
                    'display_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('site-settings.index')
            ->with('stores_success', 'Store locations updated successfully!');
    }

    public function updateBankAccounts(Request $request)
    {
        $validated = $request->validate([
            'bank_accounts' => 'nullable|array|max:2',
            'bank_accounts.*.bank_name' => 'required|string|max:120',
            'bank_accounts.*.account_holder_name' => 'required|string|max:120',
            'bank_accounts.*.account_number' => 'required|string|max:60',
            'bank_accounts.*.branch' => 'nullable|string|max:120',
        ]);

        SiteSetting::saveBankAccounts($validated['bank_accounts'] ?? []);

        return redirect()
            ->route('site-settings.index')
            ->with('bank_accounts_success', 'Bank accounts updated successfully!');
    }
}
