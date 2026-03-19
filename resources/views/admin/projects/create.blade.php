@extends('admin.layout')

@section('title', 'Create Project')

@section('content')
<h1 class="page-title">Create New Project</h1>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- AI Generation Card -->
    <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
        <h2 style="color: white; margin-bottom: 1rem;">✨ AI Generation (Recommended)</h2>
        <p style="margin-bottom: 1.5rem; opacity: 0.9;">Let AI create everything for you! Just enter a project title and we'll generate the image, descriptions, and icon.</p>
        
        <form method="POST" action="{{ route('admin.projects.generate-ai') }}">
            @csrf
            
            <div class="form-group">
                <label for="ai_project_title" style="color: white;">Project Title</label>
                <input type="text" id="ai_project_title" name="project_title" placeholder="e.g., POS to manage business" required style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.3); color: white;">
            </div>
            
            <button type="submit" class="btn btn-success" style="width: 100%; background: white; color: #667eea;">
                🚀 Generate with AI
            </button>
        </form>
    </div>

    <!-- Manual Creation Card -->
    <div class="card">
        <h2 style="margin-bottom: 1rem;">📝 Manual Creation</h2>
        <p style="margin-bottom: 1.5rem; color: #7f8c8d;">Create a project manually by filling in all details yourself.</p>
        <a href="#manual-form" onclick="document.getElementById('manual-form').scrollIntoView({behavior: 'smooth'})" class="btn btn-primary" style="width: 100%; text-align: center;">
            Create Manually
        </a>
    </div>
</div>

<div class="card" id="manual-form">
    <h2 style="margin-bottom: 1.5rem;">Manual Project Creation</h2>
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="icon">Icon (Emoji)</label>
            <input type="text" id="icon" name="icon" value="{{ old('icon') }}" required>
        </div>
        
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="description_en">Description (English)</label>
            <textarea id="description_en" name="description_en" required>{{ old('description_en') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="description_fr">Description (French)</label>
            <textarea id="description_fr" name="description_fr" required>{{ old('description_fr') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="order">Order</label>
            <input type="number" id="order" name="order" value="{{ old('order', 0) }}" required>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" checked>
                Active
            </label>
        </div>
        
        <div>
            <button type="submit" class="btn btn-success">Create Project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-warning">Cancel</a>
        </div>
    </form>
</div>
@endsection
