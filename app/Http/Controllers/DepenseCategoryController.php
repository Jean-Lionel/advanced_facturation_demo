<?php

namespace App\Http\Controllers;

use App\Models\DepenseCategory;
use Illuminate\Http\Request;

class DepenseCategoryController extends Controller
{
    public function index()
    {
        $depenseCategories = DepenseCategory::latest()->paginate(20);

        return view('depense_categories.index', compact('depenseCategories'));
    }

    public function create()
    {
        return view('depense_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|unique:depense_categories,name',
            'description' => 'nullable|string',
        ]);

        DepenseCategory::create($request->only(['name', 'description']));

        return redirect()->route('depense-categories.index');
    }

    public function edit(DepenseCategory $depense_category)
    {
        return view('depense_categories.edit', compact('depense_category'));
    }

    public function update(Request $request, DepenseCategory $depense_category)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|unique:depense_categories,name,' . $depense_category->id,
            'description' => 'nullable|string',
        ]);

        $depense_category->update($request->only(['name', 'description']));

        return redirect()->route('depense-categories.index');
    }

    public function destroy(DepenseCategory $depense_category)
    {
        $depense_category->delete();

        return redirect()->route('depense-categories.index');
    }
}