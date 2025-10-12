<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\WebsiteInfo;

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
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('Client.layouts.client', compact('categories', 'products', 'promotions', 'websiteInfo'));
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

        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record

        return view('Client.layouts.client', [
            'categories' => Category::all(),
            'products'   => $products,
            'promotions' => Promotion::where('is_active', true)->latest()->get(),
            'searchQuery'=> $query,
            'websiteInfo' => $websiteInfo,
        ]);
    }

    public function cart()
    {
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('Client.cart.index',compact('websiteInfo')); // 
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
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('client.products.index', compact('product', 'websiteInfo'));
    }

    public function checkout(Product $product)
    {
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('client.cart.checkout', compact('product', 'websiteInfo'));
    }

    public function orders(Product $product)
    {
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('client.cart.orders', compact('product','websiteInfo'));
    }

    public function getByCategory($id)
    {
        $categories = Category::all();
        $promotions = Promotion::where('is_active', true)->latest()->get();
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        if($id === 'all'){
            $products = Product::with('category')->latest()->simplePaginate(8);
        } else {
            $products = Product::with('category')->where('category_id', $id)->latest()->simplePaginate(8);
        }

        return view('Client.layouts.client', compact('categories', 'products', 'promotions','websiteInfo'));
    }
 
}
