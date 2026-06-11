<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\SiteSetting;

class DashboardController extends Controller
{
    public function index()
    {
        // Total items in the table
        $totalItems = Item::count();

        // Low stock: stock_items <= 5
        $lowStockItems = Item::where('stock_items', '<=', 5)->count();

        // Count distinct categories from the Category model
        $categoriesCount = Category::count();

        // Out of stock: using the availability column
        $outOfStock = Item::where('stock_items', 0)->count();

        // Recent items (last 5 added)
        $recentItems = Item::with(['category', 'photos'])
            ->latest()
            ->take(5)
            ->get();

        // Top categories with item counts
        $topCategories = Category::withCount('items')
            ->orderByDesc('items_count')
            ->take(5)
            ->get();

        $homeHeroImage = SiteSetting::getValue('home_hero_image');
        $homeHeroVideo = SiteSetting::getValue('home_hero_video');

        return view('dashboard', compact(
            'totalItems',
            'lowStockItems',
            'categoriesCount',
            'outOfStock',
            'recentItems',
            'topCategories',
            'homeHeroImage',
            'homeHeroVideo'
        ));
    }

    public function updateHomeHeroImage(Request $request)
    {
        $validated = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'hero_video' => 'nullable|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
        ]);

        if (!$request->hasFile('hero_image') && !$request->hasFile('hero_video')) {
            return redirect()
                ->route('dashboard')
                ->withErrors(['hero_image' => 'Please upload at least an image or a video.'])
                ->withInput();
        }

        SiteSetting::saveHeroMedia(
            $validated['hero_image'] ?? null,
            $validated['hero_video'] ?? null,
            auth()->id()
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'Homepage hero media updated successfully!');
    }
}