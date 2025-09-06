<?php

namespace App\Http\Controllers\Web\Backend\CMS\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('backend.layouts.category.list', compact('categories'));
    }
    public function create()
    {
        return view('backend.layouts.category.add');
    }
    public function store(Request $request)
    {
        //  Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        //  Save data
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        //  Redirect with success message
        return redirect()->route('categories.index')
            ->with('message', 'Category created successfully!');
    }
    public function edit(Category $category)
    {
        //  Load the category and pass it to the edit view
        return view('backend.layouts.category.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        //  Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // Update category
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        //  Redirect with success message
        return redirect()->route('categories.index')
            ->with('message', 'Category updated successfully!');
    }
    public function destroy(Category $category)
    {
        //  Delete category
        $category->delete();

        //  Redirect with success message
        return redirect()->route('categories.index')
            ->with('message', 'Category deleted successfully!');
    }
}
