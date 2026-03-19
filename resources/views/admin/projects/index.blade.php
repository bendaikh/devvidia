@extends('admin.layout')

@section('title', 'Projects')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 class="page-title" style="margin-bottom: 0;">Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add New Project</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Image/Icon</th>
                <th>Name</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>
                    @if($project->image_path)
                        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->name }}" style="width: 80px; height: 45px; object-fit: cover; border-radius: 4px;">
                    @else
                        <span style="font-size: 1.5rem;">{{ $project->icon }}</span>
                    @endif
                </td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->order }}</td>
                <td>
                    <span class="badge badge-{{ $project->is_active ? 'active' : 'inactive' }}">
                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Edit</a>
                    
                    @if($project->image_path)
                    <form method="POST" action="{{ route('admin.projects.regenerate-image', $project) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem; background: #10b981;" onclick="return confirm('Regenerate this project image? This will create a new, improved version.')">🔄 Regenerate</button>
                    </form>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
