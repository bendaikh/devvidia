@extends('admin.layout')

@section('title', 'Lead Submissions')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 class="page-title">Lead Submissions</h1>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div style="margin-bottom: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
        <span style="padding: 0.5rem 1rem; background: #e0f2fe; border-radius: 8px; font-weight: 600; color: #0369a1;">
            Total Leads: {{ $leads->total() }}
        </span>
        <span style="padding: 0.5rem 1rem; background: #dcfce7; border-radius: 8px; font-weight: 600; color: #15803d;">
            New: {{ App\Models\LeadSubmission::where('status', 'new')->count() }}
        </span>
        <span style="padding: 0.5rem 1rem; background: #fef3c7; border-radius: 8px; font-weight: 600; color: #92400e;">
            Contacted: {{ App\Models\LeadSubmission::where('status', 'contacted')->count() }}
        </span>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Landing Page</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leads as $lead)
            <tr>
                <td>{{ $lead->name }}</td>
                <td>{{ $lead->phone }}</td>
                <td>
                    <span style="padding: 0.4rem 0.8rem; background: linear-gradient(135deg, #42b883 0%, #35495e 100%); color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                        {{ ucfirst($lead->landing_page) }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $lead->status }}">
                        {{ ucfirst($lead->status) }}
                    </span>
                </td>
                <td>{{ $lead->created_at->format('M d, Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                    <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirm('Are you sure you want to delete this lead?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 3rem; color: #64748b;">
                    No lead submissions yet. Leads from landing pages will appear here.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 1.5rem;">
        {{ $leads->links() }}
    </div>
</div>
@endsection
