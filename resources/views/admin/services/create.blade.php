@extends('admin.layout')

@section('title', 'Create Service')

@section('content')
<h1 class="page-title">Create New Service</h1>

<div class="card">
    <form method="POST" action="{{ route('admin.services.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="icon">Icon (Emoji)</label>
            <input type="text" id="icon" name="icon" value="{{ old('icon') }}" required>
        </div>
        
        <div class="form-group">
            <label for="title_en">Title (English)</label>
            <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" required>
        </div>
        
        <div class="form-group">
            <label for="title_fr">Title (French)</label>
            <input type="text" id="title_fr" name="title_fr" value="{{ old('title_fr') }}" required>
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
            <button type="submit" class="btn btn-success">Create Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-warning">Cancel</a>
        </div>
    </form>
</div>
@endsection
