<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;

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

        return view('dashboard', compact(
            'totalItems',
            'lowStockItems',
            'categoriesCount',
            'outOfStock',
            'recentItems',
            'topCategories'
        ));
    }
}