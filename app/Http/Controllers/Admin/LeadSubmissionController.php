<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadSubmission;
use Illuminate\Http\Request;

class LeadSubmissionController extends Controller
{
    public function index()
    {
        $leads = LeadSubmission::latest()->paginate(20);
        return view('admin.leads.index', compact('leads'));
    }

    public function show(LeadSubmission $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, LeadSubmission $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,qualified,converted,lost',
        ]);

        $lead->update($validated);

        return redirect()->back()->with('success', 'Lead status updated successfully!');
    }

    public function destroy(LeadSubmission $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully!');
    }
}
