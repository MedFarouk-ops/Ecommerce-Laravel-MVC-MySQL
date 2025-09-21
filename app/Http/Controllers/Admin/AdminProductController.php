<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    // Show admin dashboard
    public function index()
    {
        return view('Admin.products.index');
    }
}
