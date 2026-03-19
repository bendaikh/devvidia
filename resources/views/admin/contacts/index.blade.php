@extends('admin.layout')

@section('title', 'Contact Submissions')

@section('content')
<h1 class="page-title">Contact Submissions</h1>

<div class="card">
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
            @foreach($submissions as $submission)
            <tr>
                <td>{{ $submission->name }}</td>
                <td>{{ $submission->phone }}</td>
                <td>
                    <span class="badge badge-{{ $submission->status }}">
                        {{ ucfirst($submission->status) }}
                    </span>
                </td>
                <td>{{ $submission->created_at->format('M d, Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.contacts.show', $submission) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                    <form method="POST" action="{{ route('admin.contacts.destroy', $submission) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 1.5rem;">
        {{ $submissions->links() }}
    </div>
</div>
@endsection
