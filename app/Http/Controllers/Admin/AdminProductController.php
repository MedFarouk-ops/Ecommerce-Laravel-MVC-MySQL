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
        $products = Product::with('category')->get();
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

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
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
            ]);

            $product->update($request->all());

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}
