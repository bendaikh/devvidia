<?php

namespace App\Http\Controllers;

use App\Models\LeadSubmission;
use App\Models\LandingPage;
use App\Models\ApiSetting;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function systems()
    {
        $landingPage = LandingPage::where('slug', 'systems')->firstOrFail();
        
        if (!$landingPage->is_active) {
            abort(404);
        }
        
        $landingPage->incrementViews();
        
        $whatsappPhone = ApiSetting::get('whatsapp_phone') ?? '+237123456789';
        
        return view('landing-pages.' . $landingPage->template, compact('whatsappPhone', 'landingPage'));
    }

    public function submitLead(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'project_idea' => 'required|string',
            'landing_page' => 'required|string|max:50',
        ]);

        LeadSubmission::create($validated);
        
        $landingPage = LandingPage::where('slug', $validated['landing_page'])->first();
        if ($landingPage) {
            $landingPage->incrementSubmissions();
        }

        return response()->json([
            'success' => true, 
            'message' => 'Thank you for your interest! We will contact you soon to discuss your project.'
        ]);
    }
}
