@extends('admin.layout')

@section('title', 'Edit Landing Page')

@section('content')
<h1 class="page-title">Edit Landing Page</h1>

<div class="card">
    <form method="POST" action="{{ route('admin.landing-systems.update', $landingSystem) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Landing Page Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $landingSystem->name) }}" required>
            @error('name')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="slug">URL Slug *</label>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: #64748b;">/landing/</span>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $landingSystem->slug) }}" required style="flex: 1;">
            </div>
            <small style="color: #64748b;">Used in URL: /landing/your-slug</small>
            @error('slug')
                <small style="color: #e74c3c; display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="title">Page Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $landingSystem->title) }}" required>
            <small style="color: #64748b;">Appears in browser tab</small>
            @error('title')
                <small style="color: #e74c3c; display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $landingSystem->description) }}</textarea>
            @error('description')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="template">Template *</label>
            <select id="template" name="template" required>
                <option value="systems" {{ old('template', $landingSystem->template) == 'systems' ? 'selected' : '' }}>Systems (Default)</option>
                <option value="custom" {{ old('template', $landingSystem->template) == 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            <small style="color: #64748b;">Choose the design template for this landing page</small>
            @error('template')
                <small style="color: #e74c3c; display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', $landingSystem->is_active) ? 'checked' : '' }}>
                <span>Active (visitors can access this page)</span>
            </label>
        </div>
        
        <div style="padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid #42b883;">
            <h4 style="margin-bottom: 0.5rem; color: #2c3e50;">Performance Stats</h4>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; font-size: 0.9rem; color: #64748b;">
                <div>
                    <strong style="color: #2c3e50;">{{ number_format($landingSystem->views) }}</strong> Views
                </div>
                <div>
                    <strong style="color: #2c3e50;">{{ number_format($landingSystem->submissions) }}</strong> Submissions
                </div>
                <div>
                    <strong style="color: #2c3e50;">{{ $landingSystem->conversion_rate }}%</strong> Conversion
                </div>
            </div>
        </div>
        
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Update Landing Page</button>
            <a href="{{ route('admin.landing-systems.index') }}" class="btn btn-primary">Cancel</a>
            <a href="{{ url('/landing/' . $landingSystem->slug) }}" target="_blank" class="btn btn-warning">Preview Page</a>
        </div>
    </form>
</div>
@endsection
