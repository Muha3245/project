<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $subcategories = Subcategory::where('category_id', $categoryId)->get();

        return view('subcategories.index', compact('category', 'subcategories'));
    }

    public function create($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('subcategories.create', compact('category'));
    }

    public function store(Request $request, $categoryId)
    {
        $request->validate(['name' => 'required']);

        // Create the subcategory with the category_id set
        Subcategory::create([
            'name' => $request->name,
            'category_id' => $categoryId, // Use the passed categoryId
        ]);

        return redirect()->route('categories.subcategories.index', $categoryId)
            ->with('success', 'Subcategory created successfully.');
    }

    public function edit($categoryId, Subcategory $subcategory)
{
    $category = Category::findOrFail($categoryId);
    return view('subcategories.edit', compact('subcategory', 'category'));
}


public function update(Request $request, $categoryId, Subcategory $subcategory)
{
    $request->validate(['name' => 'required']);
    $subcategory->update($request->all());

    return redirect()->route('categories.subcategories.index', $categoryId)->with('success', 'Subcategory updated successfully.');
}

public function destroy($categoryId, Subcategory $subcategory)
{
    $subcategory->delete();
    return redirect()->route('categories.subcategories.index', $categoryId)->with('success', 'Subcategory deleted successfully.');
}

}
