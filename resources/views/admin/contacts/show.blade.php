@extends('admin.layout')

@section('title', 'View Submission')

@section('content')
<h1 class="page-title">Contact Submission Details</h1>

<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Contact Information</h2>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Name:</strong> {{ $contactSubmission->name }}
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Phone:</strong> {{ $contactSubmission->phone }}
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Date:</strong> {{ $contactSubmission->created_at->format('F d, Y H:i') }}
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <strong>Status:</strong>
        <span class="badge badge-{{ $contactSubmission->status }}">
            {{ ucfirst($contactSubmission->status) }}
        </span>
    </div>
    
    <div style="margin-bottom: 2rem;">
        <strong>Project Idea:</strong>
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 5px; margin-top: 0.5rem;">
            {{ $contactSubmission->project_idea }}
        </div>
    </div>
    
    <form method="POST" action="{{ route('admin.contacts.update-status', $contactSubmission) }}" style="margin-bottom: 1.5rem;">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="status">Update Status</label>
            <select name="status" id="status" style="width: auto; margin-right: 1rem;">
                <option value="new" {{ $contactSubmission->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ $contactSubmission->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="completed" {{ $contactSubmission->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="btn btn-success">Update Status</button>
        </div>
    </form>
    
    <div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Back to List</a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactSubmission->phone) }}?text=Hello%20{{ urlencode($contactSubmission->name) }}" target="_blank" class="btn btn-success">Contact via WhatsApp</a>
    </div>
</div>
@endsection
