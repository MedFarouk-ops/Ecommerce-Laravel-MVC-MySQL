<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\WebsiteInfo;

class StaticPagesController extends Controller
{
      public function about(): View
    {
        $websiteInfo = WebsiteInfo::first();
        return view('Client.pages.about', compact('websiteInfo'));
    }

    public function contact(): View
    {
        $websiteInfo = WebsiteInfo::first();
        return view('Client.pages.contact', compact('websiteInfo'));
    }

    public function faq(): View
    {
        $websiteInfo = WebsiteInfo::first();
        return view('Client.pages.faq', compact('websiteInfo'));
    }

    public function privacy(): View
    {
        $websiteInfo = WebsiteInfo::first();
        return view('Client.pages.privacy', compact('websiteInfo'));
    }

    public function terms(): View
    {
        $websiteInfo = WebsiteInfo::first();
        return view('Client.pages.terms', compact('websiteInfo'));
    }
}
