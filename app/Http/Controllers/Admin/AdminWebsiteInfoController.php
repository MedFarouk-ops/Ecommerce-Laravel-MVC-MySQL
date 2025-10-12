<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Storage;

class AdminWebsiteInfoController extends Controller
{
    // Show edit form
    public function edit()
    {
        $info = WebsiteInfo::first(); // We assume only one record
        return view('Admin.website_info.index', compact('info'));
    }

    // Update website information
    public function update(Request $request)
    {
        $info = WebsiteInfo::first();
        if (!$info) {
            $info = new WebsiteInfo();
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'about_description' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Save logo if uploaded
        if ($request->hasFile('logo')) {
            if ($info->logo && Storage::exists('public/' . $info->logo)) {
                Storage::delete('public/' . $info->logo);
            }
            $logoPath = $request->file('logo')->store('website', 'public');
            $info->logo = $logoPath;
        }

        // Save other fields
        $info->name = $request->name;
        $info->hero_title = $request->hero_title;
        $info->hero_description = $request->hero_description;
        $info->about_description = $request->about_description;
        $info->phone = $request->phone;
        $info->email = $request->email;
        $info->address = $request->address;
        $info->facebook = $request->facebook;
        $info->twitter = $request->twitter;
        $info->instagram = $request->instagram;
        $info->linkedin = $request->linkedin;

        $info->save();

        return redirect()->back()->with('success', 'Website information updated successfully.');
    }
}
