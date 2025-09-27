<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        // Empty constructor
    }

    // Show admin dashboard
    public function index()
    {
        return view('Client.layouts.client');
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
