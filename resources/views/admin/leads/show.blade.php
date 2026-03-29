@extends('admin.layout')

@section('title', 'View Lead')

@section('content')
<h1 class="page-title">Lead Submission Details</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Lead Information</h2>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Name:</strong> {{ $lead->name }}
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Phone:</strong> {{ $lead->phone }}
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Landing Page:</strong>
        <span style="padding: 0.4rem 0.8rem; background: linear-gradient(135deg, #42b883 0%, #35495e 100%); color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
            {{ ucfirst($lead->landing_page) }}
        </span>
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Date:</strong> {{ $lead->created_at->format('F d, Y H:i') }}
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Status:</strong>
        <span class="badge badge-{{ $lead->status }}">
            {{ ucfirst($lead->status) }}
        </span>
    </div>
    
    <div style="margin-bottom: 2rem;">
        <strong>Project Idea:</strong>
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 5px; margin-top: 0.5rem; line-height: 1.6;">
            {{ $lead->project_idea }}
        </div>
    </div>
    
    <form method="POST" action="{{ route('admin.leads.update-status', $lead) }}" style="margin-bottom: 1.5rem;">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="status">Update Status</label>
            <select name="status" id="status" style="width: auto; margin-right: 1rem;">
                <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="qualified" {{ $lead->status == 'qualified' ? 'selected' : '' }}>Qualified</option>
                <option value="converted" {{ $lead->status == 'converted' ? 'selected' : '' }}>Converted</option>
                <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
            </select>
            <button type="submit" class="btn btn-success">Update Status</button>
        </div>
    </form>
    
    <div>
        <a href="{{ route('admin.leads.index') }}" class="btn btn-primary">Back to List</a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}?text=Hello%20{{ urlencode($lead->name) }}%2C%20thank%20you%20for%20your%20interest%20in%20our%20{{ urlencode($lead->landing_page) }}%20solutions." target="_blank" class="btn btn-success">Contact via WhatsApp</a>
    </div>
</div>
@endsection
