<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;

class ClientController extends Controller
{
    public function __construct()
    {
        // Empty constructor
    }

   // Show client landing page
    public function index()
    {
        $categories = Category::all();               // Get all categories
        $products   = Product::with('category')->latest()->simplePaginate(8); 
        $promotions = Promotion::where('is_active', true)->latest()->get(); // Get active promotions
        return view('Client.layouts.client', compact('categories', 'products', 'promotions'));
    }

    // Search products by name
    public function search_product(Request $request)
    {
        $query = $request->input('query'); // Get the search term

        // Search products where name contains the query (case-insensitive)
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->with('category')
                            ->latest()
                            ->paginate(10);

        // Preserve the search term in pagination links
        $products->appends(['query' => $query]);

        return view('Client.layouts.client', [
            'categories' => Category::all(),
            'products'   => $products,
            'promotions' => Promotion::where('is_active', true)->latest()->get(),
            'searchQuery'=> $query,
        ]);
    }

    public function cart()
    {
        return view('Client.cart.index'); // 
    }

      // Show login page
    public function showLogin()
    {
        return view('Client.auth.login');
    }

    // Show registration page
    public function showRegister()
    {
        return view('Client.auth.register');
    }

    public function show_product(Product $product)
    {
        return view('client.products.index', compact('product'));
    }

    public function checkout(Product $product)
    {
        return view('client.cart.checkout', compact('product'));
    }

    public function orders(Product $product)
    {
        return view('client.cart.orders', compact('product'));
    }
 
}
