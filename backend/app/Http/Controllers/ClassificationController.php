<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    /**
     * Display a listing of classifications
     */
    public function index()
    {
        $classifications = Classification::latest()->paginate(10);
        return view('classifications.index', compact('classifications'));
    }

    /**
     * Show the form for creating a new classification
     */
    public function create()
    {
        return view('classifications.create');
    }

    /**
     * Store a newly created classification in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classifications,name',
        ]);

        Classification::createClassification($validated);

        return redirect()->route('classifications.index')->with('success', 'Classification created successfully!');
    }

    /**
     * Display the specified classification
     */
    public function show($id)
    {
        $classification = Classification::getClassificationById($id);
        return view('classifications.show', compact('classification'));
    }

    /**
     * Show the form for editing the specified classification
     */
    public function edit($id)
    {
        $classification = Classification::getClassificationById($id);
        return view('classifications.edit', compact('classification'));
    }

    /**
     * Update the specified classification in database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classifications,name,' . $id,
        ]);

        Classification::updateClassification($id, $validated);

        return redirect()->route('classifications.index')->with('success', 'Classification updated successfully!');
    }

    /**
     * Remove the specified classification from database
     */
    public function destroy($id)
    {
        Classification::deleteClassification($id);
        return redirect()->route('classifications.index')->with('success', 'Classification deleted successfully!');
    }
}
