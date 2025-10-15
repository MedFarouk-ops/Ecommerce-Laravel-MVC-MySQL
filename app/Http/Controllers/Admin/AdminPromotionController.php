<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class AdminPromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->paginate(10);
        return view('Admin.promotions.index', compact('promotions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'required|url',
            'is_active' => 'boolean',
        ]);

        // Handle image upload like your product example
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promotions', 'public');
        }

        $promotion = Promotion::create($data);
        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion created successfully!');
    }

    public function show(Promotion $promotion)
    {
        return redirect()->route('admin.promotion.index');
    }

    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'sometimes|url',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promotions', 'public');
        }

         $promotion->update($data);

         return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('admin.promotions.index')->with('success', 'Promotion Deleted successfully.');
    }

    // Routing methods
    public function create_promotion()
    {
        return view('Admin.promotions.create');
    }

  public function edit_promotion(Promotion $promotion)
    {
        // Pass the promotion to the view
        return view('Admin.promotions.edit', compact('promotion'));
    }

    public function view_promotion()
    {
        return view('Admin.promotions.create');
    }

    // Search functionality
    public function search(Request $request)
    {
        $query = $request->input('query');

        $promotions = \App\Models\Promotion::where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Preserve the search query when paginating
        $promotions->appends(['query' => $query]);

        return view('Admin.promotions.index', compact('promotions', 'query'));
    }


}
