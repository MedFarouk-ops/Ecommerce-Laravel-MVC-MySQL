<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

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
        $products   = Product::with('category')->get(); // Get all products with their category

        return view('Client.layouts.client', compact('categories', 'products'));
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

 
}
