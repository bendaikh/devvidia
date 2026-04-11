@extends('admin.layout')

@section('title', 'Create Landing Page')

@section('content')
<h1 class="page-title">Create New Landing Page</h1>

<div class="card">
    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <strong>Please fix the following errors:</strong>
            <ul style="margin: 0.5rem 0 0 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.landing-systems.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Landing Page Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g., Systems Development Landing Page">
            @error('name')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="slug">URL Slug *</label>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="color: #64748b;">/landing/</span>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required placeholder="systems" style="flex: 1;">
            </div>
            <small style="color: #64748b;">Used in URL: /landing/your-slug</small>
            @error('slug')
                <small style="color: #e74c3c; display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="title">Page Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Custom System Development | Devvidia">
            <small style="color: #64748b;">Appears in browser tab</small>
            @error('title')
                <small style="color: #e74c3c; display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Brief description of this landing page purpose">{{ old('description') }}</textarea>
            @error('description')
                <small style="color: #e74c3c;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="template">Template *</label>
            <select id="template" name="template" required>
                <option value="systems" {{ old('template', 'systems') == 'systems' ? 'selected' : '' }}>Systems (Default)</option>
                <option value="custom" {{ old('template') == 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            <small style="color: #64748b;">Choose the design template for this landing page</small>
            @error('template')
                <small style="color: #e74c3c; display: block;">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                <span>Active (visitors can access this page)</span>
            </label>
        </div>
        
        <!-- Tracking Pixels Section -->
        <div style="padding: 1.5rem; background: #f8fafc; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #e2e8f0;">
            <h3 style="margin-bottom: 1rem; color: #1e293b; font-size: 1.1rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#42b883" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                Tracking Pixels
            </h3>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label for="tiktok_pixel_id">TikTok Pixel ID</label>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <input type="text" id="tiktok_pixel_id" name="tiktok_pixel_id" value="{{ old('tiktok_pixel_id') }}" 
                           placeholder="e.g., D70POC3C77UF6QH5QF80" 
                           style="flex: 1; font-family: monospace;">
                    <button type="button" id="paste-tiktok-btn" 
                            style="padding: 0.75rem 1rem; background: #42b883; color: white; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: all 0.2s;"
                            onmouseover="this.style.background='#3aa876'" 
                            onmouseout="this.style.background='#42b883'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        Paste
                    </button>
                </div>
                <small style="color: #64748b; display: block; margin-top: 0.5rem;">
                    Find your Pixel ID in <a href="https://ads.tiktok.com/i18n/events_manager" target="_blank" style="color: #42b883;">TikTok Ads Manager</a> → Events → Web Events → Your Pixel
                </small>
                @error('tiktok_pixel_id')
                    <small style="color: #e74c3c; display: block;">{{ $message }}</small>
                @enderror
                
                <div id="tiktok-pixel-status" style="margin-top: 0.75rem; padding: 0.75rem; border-radius: 8px; display: none;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0; margin-top: 1.5rem;">
                <label for="facebook_pixel_id">Facebook Pixel ID</label>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <input type="text" id="facebook_pixel_id" name="facebook_pixel_id" value="{{ old('facebook_pixel_id') }}" 
                           placeholder="e.g., 1234567890123456" 
                           style="flex: 1; font-family: monospace;">
                    <button type="button" id="paste-facebook-btn" 
                            style="padding: 0.75rem 1rem; background: #1877f2; color: white; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: all 0.2s;"
                            onmouseover="this.style.background='#166fe5'" 
                            onmouseout="this.style.background='#1877f2'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        Paste
                    </button>
                </div>
                <small style="color: #64748b; display: block; margin-top: 0.5rem;">
                    Find your Pixel ID in <a href="https://business.facebook.com/events_manager2" target="_blank" style="color: #1877f2;">Meta Events Manager</a> → Data Sources → Pixels → Settings
                </small>
                @error('facebook_pixel_id')
                    <small style="color: #e74c3c; display: block;">{{ $message }}</small>
                @enderror
                
                <div id="facebook-pixel-status" style="margin-top: 0.75rem; padding: 0.75rem; border-radius: 8px; display: none;">
                </div>
            </div>
        </div>
        
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Create Landing Page</button>
            <a href="{{ route('admin.landing-systems.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.autoGenerated) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
    });
    
    slugInput.addEventListener('input', function() {
        if (this.value) {
            this.dataset.autoGenerated = 'false';
        }
    });
    
    // Paste button for TikTok Pixel ID
    const pasteTikTokBtn = document.getElementById('paste-tiktok-btn');
    const tiktokPixelInput = document.getElementById('tiktok_pixel_id');
    const tiktokPixelStatus = document.getElementById('tiktok-pixel-status');
    
    pasteTikTokBtn.addEventListener('click', async function() {
        try {
            const text = await navigator.clipboard.readText();
            tiktokPixelInput.value = text.trim();
            validateTikTokPixelId(text.trim());
        } catch (err) {
            showPixelStatus(tiktokPixelStatus, 'Unable to paste. Please paste manually (Ctrl+V)', 'error');
        }
    });
    
    tiktokPixelInput.addEventListener('input', function() {
        if (this.value.trim()) {
            validateTikTokPixelId(this.value.trim());
        } else {
            tiktokPixelStatus.style.display = 'none';
        }
    });
    
    function validateTikTokPixelId(pixelId) {
        // TikTok Pixel IDs are typically alphanumeric, 20 characters
        const isValidFormat = /^[A-Z0-9]{15,25}$/i.test(pixelId);
        
        if (isValidFormat) {
            showPixelStatus(tiktokPixelStatus, '✓ Valid TikTok Pixel ID format. The pixel will be activated when you save.', 'success');
        } else {
            showPixelStatus(tiktokPixelStatus, '⚠ This doesn\'t look like a valid TikTok Pixel ID. Please check and try again.', 'warning');
        }
    }
    
    // Paste button for Facebook Pixel ID
    const pasteFacebookBtn = document.getElementById('paste-facebook-btn');
    const facebookPixelInput = document.getElementById('facebook_pixel_id');
    const facebookPixelStatus = document.getElementById('facebook-pixel-status');
    
    pasteFacebookBtn.addEventListener('click', async function() {
        try {
            const text = await navigator.clipboard.readText();
            facebookPixelInput.value = text.trim();
            validateFacebookPixelId(text.trim());
        } catch (err) {
            showPixelStatus(facebookPixelStatus, 'Unable to paste. Please paste manually (Ctrl+V)', 'error');
        }
    });
    
    facebookPixelInput.addEventListener('input', function() {
        if (this.value.trim()) {
            validateFacebookPixelId(this.value.trim());
        } else {
            facebookPixelStatus.style.display = 'none';
        }
    });
    
    function validateFacebookPixelId(pixelId) {
        // Facebook Pixel IDs are typically 15-16 digit numbers
        const isValidFormat = /^[0-9]{15,16}$/i.test(pixelId);
        
        if (isValidFormat) {
            showPixelStatus(facebookPixelStatus, '✓ Valid Facebook Pixel ID format. The pixel will be activated when you save.', 'success');
        } else {
            showPixelStatus(facebookPixelStatus, '⚠ This doesn\'t look like a valid Facebook Pixel ID. Please check and try again.', 'warning');
        }
    }
    
    function showPixelStatus(statusElement, message, type) {
        statusElement.style.display = 'block';
        statusElement.textContent = message;
        
        if (type === 'success') {
            statusElement.style.background = '#d1fae5';
            statusElement.style.color = '#065f46';
            statusElement.style.border = '1px solid #42b883';
        } else if (type === 'error') {
            statusElement.style.background = '#fee2e2';
            statusElement.style.color = '#991b1b';
            statusElement.style.border = '1px solid #ef4444';
        } else if (type === 'warning') {
            statusElement.style.background = '#fef3c7';
            statusElement.style.color = '#92400e';
            statusElement.style.border = '1px solid #f59e0b';
        }
    }
</script>
@endsection
