<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingSystemController extends Controller
{
    public function index()
    {
        $landingPages = LandingPage::withCount('leads')->latest()->paginate(20);
        return view('admin.landing-systems.index', compact('landingPages'));
    }

    public function create()
    {
        return view('admin.landing-systems.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:landing_pages,slug',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template' => 'required|string',
            'tiktok_pixel_id' => 'nullable|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Build settings JSON
        $validated['settings'] = [
            'tiktok_pixel_id' => $request->input('tiktok_pixel_id'),
        ];
        
        // Remove tiktok_pixel_id from validated as it's now in settings
        unset($validated['tiktok_pixel_id']);

        LandingPage::create($validated);

        return redirect()->route('admin.landing-systems.index')->with('success', 'Landing page created successfully!');
    }

    public function edit(LandingPage $landingSystem)
    {
        return view('admin.landing-systems.edit', compact('landingSystem'));
    }

    public function update(Request $request, LandingPage $landingSystem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:landing_pages,slug,' . $landingSystem->id,
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template' => 'required|string',
            'tiktok_pixel_id' => 'nullable|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Merge with existing settings and update TikTok Pixel ID
        $existingSettings = $landingSystem->settings ?? [];
        $validated['settings'] = array_merge($existingSettings, [
            'tiktok_pixel_id' => $request->input('tiktok_pixel_id'),
        ]);
        
        // Remove tiktok_pixel_id from validated as it's now in settings
        unset($validated['tiktok_pixel_id']);

        $landingSystem->update($validated);

        return redirect()->route('admin.landing-systems.index')->with('success', 'Landing page updated successfully!');
    }

    public function destroy(LandingPage $landingSystem)
    {
        $landingSystem->delete();
        return redirect()->route('admin.landing-systems.index')->with('success', 'Landing page deleted successfully!');
    }
}
