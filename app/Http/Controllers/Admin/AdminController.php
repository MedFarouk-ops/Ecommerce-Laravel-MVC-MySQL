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
        return view('Admin.dashboard');
    }

    public function showLogin()
    {
        return view('Admin.auth.login');
    }
}
