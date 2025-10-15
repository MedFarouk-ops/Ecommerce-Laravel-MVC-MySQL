<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        // Fetch categories, latest first, 10 per page
        $categories = Category::latest()->paginate(10);

        return view('Admin.categories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('Admin.categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only(['name', 'description']));

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully!');
    }
    
     // Show edit form
    public function edit(Category $category)
    {
        return view('Admin.categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'description']));

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully!');
    }

    // Search method
    public function search(Request $request)
    {
        $query = $request->input('query'); // Get the search keyword

        // Search categories by name (case-insensitive)
        $categories = Category::where('name', 'like', "%{$query}%")
            ->latest()
            ->paginate(10);

        // Keep the search query when paginating
        $categories->appends(['query' => $query]);

        // Return the same view with filtered results
        return view('Admin.categories.index', compact('categories', 'query'));
    }
    
}
