<?php

namespace App\Http\Controllers;

use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{
    /**
     * Display a listing of offer categories.
     */
    public function index()
    {
        $offerCategories = OfferCategory::orderBy('name', 'asc')->paginate(10);

        return view('offer-categories.index', compact('offerCategories'));
    }

    /**
     * Store a newly created offer category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255|unique:offer_categories,name',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        OfferCategory::createOfferCategory($validated);

        return redirect()->route('offer-categories.index')->with('success', 'Offer category created successfully!');
    }

    /**
     * Update the specified offer category.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255|unique:offer_categories,name,' . $id,
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        OfferCategory::updateOfferCategory($id, $validated);

        return redirect()->route('offer-categories.index')->with('success', 'Offer category updated successfully!');
    }

    /**
     * Remove the specified offer category.
     */
    public function destroy($id)
    {
        OfferCategory::deleteOfferCategory($id);

        return redirect()->route('offer-categories.index')->with('success', 'Offer category deleted successfully!');
    }
}
