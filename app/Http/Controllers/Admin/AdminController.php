<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Empty constructor
    }

    // Show admin dashboard
    public function index()
    {
        $orders = \App\Models\Order::with(['user', 'items.product'])
            ->latest()
            ->take(5) // Show only latest 5 orders
            ->get();

        return view('Admin.dashboard', compact('orders'));
    }

    public function showLogin()
    {
        return view('Admin.auth.login');
    }
}
