<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\ContactSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services_count' => Service::count(),
            'projects_count' => Project::count(),
            'new_submissions' => ContactSubmission::where('status', 'new')->count(),
            'total_submissions' => ContactSubmission::count(),
        ];

        $recentSubmissions = ContactSubmission::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions'));
    }
}
