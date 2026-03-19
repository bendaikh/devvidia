@extends('admin.layout')

@section('title', 'Services')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 class="page-title" style="margin-bottom: 0;">Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add New Service</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title (EN)</th>
                <th>Title (FR)</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td style="font-size: 1.5rem;">{{ $service->icon }}</td>
                <td>{{ $service->title_en }}</td>
                <td>{{ $service->title_fr }}</td>
                <td>{{ $service->order }}</td>
                <td>
                    <span class="badge badge-{{ $service->is_active ? 'active' : 'inactive' }}">
                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Edit</a>
                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" style="display: inline;">
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
