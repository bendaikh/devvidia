@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="page-title">Dashboard</h1>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Services</h3>
        <div class="value">{{ $stats['services_count'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Projects</h3>
        <div class="value">{{ $stats['projects_count'] }}</div>
    </div>
    <div class="stat-card">
        <h3>New Submissions</h3>
        <div class="value">{{ $stats['new_submissions'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Submissions</h3>
        <div class="value">{{ $stats['total_submissions'] }}</div>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom: 1rem;">Recent Contact Submissions</h2>
    
    @if($recentSubmissions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentSubmissions as $submission)
                <tr>
                    <td>{{ $submission->name }}</td>
                    <td>{{ $submission->phone }}</td>
                    <td>
                        <span class="badge badge-{{ $submission->status }}">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </td>
                    <td>{{ $submission->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $submission) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #7f8c8d;">No contact submissions yet.</p>
    @endif
</div>
@endsection
