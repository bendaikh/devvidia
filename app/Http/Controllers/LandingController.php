<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\ContactSubmission;
use App\Models\ApiSetting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        $projects = Project::active()->ordered()->get();
        $whatsappPhone = ApiSetting::get('whatsapp_phone') ?? '+237123456789'; // Default fallback
        
        return view('landing', compact('services', 'projects', 'whatsappPhone'));
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'project_idea' => 'required|string',
        ]);

        ContactSubmission::create($validated);

        return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
    }
}
