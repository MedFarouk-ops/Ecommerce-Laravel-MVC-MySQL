<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Show admin dashboard
    public function index()
    {
        return view('Client.layouts.client');
    }
}
