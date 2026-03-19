@extends('admin.layout')

@section('title', 'API Settings')

@section('content')
<h1 class="page-title">API Integration Settings</h1>

<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Configure AI Services</h2>
    
    <form method="POST" action="{{ route('admin.api-settings.update') }}">
        @csrf
        
        <div class="form-group">
            <label for="ideogram_api_key">Ideogram API Key</label>
            <div style="display: flex; gap: 1rem; align-items: start;">
                <input type="text" id="ideogram_api_key" name="ideogram_api_key" value="{{ old('ideogram_api_key', $settings['ideogram_api_key']) }}" placeholder="Enter your Ideogram API key" style="flex: 1;">
                <button type="button" id="testConnectionBtn" class="btn btn-primary" onclick="testConnection()" style="white-space: nowrap;">
                    🔌 Test Connection
                </button>
            </div>
            <small style="color: #7f8c8d; display: block; margin-top: 0.5rem;">
                Get your API key from <a href="https://ideogram.ai/api" target="_blank" style="color: #3498db;">Ideogram AI Dashboard</a>
            </small>
            <div id="testResult" style="margin-top: 1rem; padding: 1rem; border-radius: 5px; display: none;"></div>
        </div>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.1rem; margin-bottom: 1rem;">How to Get Your Ideogram API Key:</h3>
            <ol style="margin-left: 1.5rem; line-height: 2;">
                <li>Go to <a href="https://ideogram.ai" target="_blank" style="color: #3498db;">ideogram.ai</a></li>
                <li>Sign up or log in to your account</li>
                <li>Navigate to the API section</li>
                <li>Generate a new API key</li>
                <li>Copy and paste it here</li>
            </ol>
        </div>
        
        <div style="background: #d4edda; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; color: #155724;">
            <h3 style="font-size: 1.1rem; margin-bottom: 1rem;">✨ What AI Generation Does:</h3>
            <ul style="margin-left: 1.5rem; line-height: 2;">
                <li><strong>Project Images:</strong> Generates professional mockups showing your project on devices</li>
                <li><strong>Descriptions:</strong> Creates compelling descriptions in English and French</li>
                <li><strong>Icons:</strong> Automatically selects appropriate emojis based on project type</li>
                <li><strong>Time Saved:</strong> Creates a complete project in seconds instead of minutes!</li>
            </ul>
        </div>
        
        <div>
            <button type="submit" class="btn btn-success">Save API Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Cancel</a>
        </div>
    </form>
</div>

<script>
async function testConnection() {
    const apiKey = document.getElementById('ideogram_api_key').value;
    const testBtn = document.getElementById('testConnectionBtn');
    const testResult = document.getElementById('testResult');
    
    if (!apiKey) {
        testResult.style.display = 'block';
        testResult.style.background = '#f8d7da';
        testResult.style.color = '#721c24';
        testResult.style.border = '1px solid #f5c6cb';
        testResult.innerHTML = '❌ Please enter an API key first.';
        return;
    }
    
    // Show loading state
    testBtn.disabled = true;
    testBtn.innerHTML = '⏳ Testing...';
    testResult.style.display = 'block';
    testResult.style.background = '#d1ecf1';
    testResult.style.color = '#0c5460';
    testResult.style.border = '1px solid #bee5eb';
    testResult.innerHTML = '🔄 Testing connection to Ideogram API...';
    
    try {
        const response = await fetch('{{ route('admin.api-settings.test') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                api_key: apiKey
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            testResult.style.background = '#d4edda';
            testResult.style.color = '#155724';
            testResult.style.border = '1px solid #c3e6cb';
            testResult.innerHTML = `
                ✅ <strong>Connection Successful!</strong><br>
                <small>${data.message}</small>
            `;
        } else {
            testResult.style.background = '#f8d7da';
            testResult.style.color = '#721c24';
            testResult.style.border = '1px solid #f5c6cb';
            testResult.innerHTML = `
                ❌ <strong>Connection Failed</strong><br>
                <small>${data.message}</small>
            `;
        }
    } catch (error) {
        testResult.style.background = '#f8d7da';
        testResult.style.color = '#721c24';
        testResult.style.border = '1px solid #f5c6cb';
        testResult.innerHTML = `
            ❌ <strong>Error Testing Connection</strong><br>
            <small>${error.message}</small>
        `;
    } finally {
        testBtn.disabled = false;
        testBtn.innerHTML = '🔌 Test Connection';
    }
}
</script>
@endsection
