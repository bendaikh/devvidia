@extends('admin.layout')

@section('title', 'Edit Project')

@section('content')
<h1 class="page-title">Edit Project</h1>

<div class="card">
    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="icon">Icon (Emoji)</label>
            <input type="text" id="icon" name="icon" value="{{ old('icon', $project->icon) }}" required>
        </div>
        
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" required>
        </div>
        
        <div class="form-group">
            <label for="description_en">Description (English)</label>
            <textarea id="description_en" name="description_en" required>{{ old('description_en', $project->description_en) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="description_fr">Description (French)</label>
            <textarea id="description_fr" name="description_fr" required>{{ old('description_fr', $project->description_fr) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="order">Order</label>
            <input type="number" id="order" name="order" value="{{ old('order', $project->order) }}" required>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>
        
        <div>
            <button type="submit" class="btn btn-success">Update Project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-warning">Cancel</a>
        </div>
    </form>
</div>
@endsection
