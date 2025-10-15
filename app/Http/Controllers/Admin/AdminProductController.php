<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    public function index()
    {
        // Fetch products with their related category, 10 per page
        $products = Product::with('category')
            ->latest() // optional: order by latest
            ->paginate(10);

        return view('Admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'base_price'  => 'required|numeric|min:0', // added
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'photo1'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo2'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Handle photo uploads
        if ($request->hasFile('photo1')) {
            $data['photo1'] = $request->file('photo1')->store('products', 'public');
        }

        if ($request->hasFile('photo2')) {
            $data['photo2'] = $request->file('photo2')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('Admin.products.edit', compact('product', 'categories'));
    }

   public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'base_price'  => 'required|numeric|min:0', // added
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'photo1'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo2'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Handle updated photo uploads
        if ($request->hasFile('photo1')) {
            $data['photo1'] = $request->file('photo1')->store('products', 'public');
        }

        if ($request->hasFile('photo2')) {
            $data['photo2'] = $request->file('photo2')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product updated successfully.');
    }


        public function destroy(Product $product)
        {
            $product->delete();

            return redirect()->route('admin.products.index')
                            ->with('success', 'Product deleted successfully!');
        }

        // Search method
        public function search(Request $request)
        {
            $query = $request->input('query'); // Get the search input from the request

            // Search products by name and paginate results (10 per page)
            $products = Product::with('category')
                ->where('name', 'like', "%{$query}%")
                ->latest()
                ->paginate(10);

            // Keep the query in pagination links
            $products->appends(['query' => $query]);

            // Return the same index view with filtered results
            return view('Admin.products.index', compact('products', 'query'));
        }
}
