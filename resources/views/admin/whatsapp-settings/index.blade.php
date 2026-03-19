@extends('admin.layout')

@section('title', 'WhatsApp Settings')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 class="page-title" style="margin-bottom: 0;">WhatsApp Settings</h1>
</div>

<div class="card" style="max-width: 800px;">
    <h2 style="margin-bottom: 1.5rem; color: #2c3e50;">Configure WhatsApp Contact</h2>
    <p style="margin-bottom: 2rem; color: #7f8c8d;">
        Set your WhatsApp phone number here. All WhatsApp buttons on your landing page will redirect visitors to this number.
    </p>

    <form method="POST" action="{{ route('admin.whatsapp-settings.update') }}">
        @csrf
        
        <div class="form-group">
            <label for="whatsapp_phone">
                WhatsApp Phone Number 
                <span style="color: #e74c3c;">*</span>
            </label>
            <input 
                type="text" 
                id="whatsapp_phone" 
                name="whatsapp_phone" 
                value="{{ old('whatsapp_phone', $whatsappPhone) }}" 
                placeholder="e.g., +237123456789"
                required
                style="font-size: 1.1rem; padding: 1rem;">
            <small style="display: block; margin-top: 0.5rem; color: #7f8c8d;">
                📱 Include country code (e.g., +237 for Cameroon, +1 for USA). 
                <br>
                ✅ Format: +[country code][phone number] (no spaces or dashes needed)
                <br>
                Example: <code style="background: #f8f9fa; padding: 0.2rem 0.5rem; border-radius: 3px;">+237612345678</code>
            </small>
            @error('whatsapp_phone')
                <small style="color: #e74c3c; display: block; margin-top: 0.5rem;">{{ $message }}</small>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-success" style="padding: 1rem 2rem;">
                💾 Save WhatsApp Number
            </button>
            
            <button type="button" id="testWhatsApp" class="btn btn-primary" style="padding: 1rem 2rem;">
                🧪 Test Connection
            </button>
        </div>
    </form>

    <div id="testResult" style="margin-top: 2rem; display: none;"></div>
</div>

<div class="card" style="max-width: 800px; margin-top: 2rem; background: #f8f9fa;">
    <h3 style="color: #2c3e50; margin-bottom: 1rem;">💡 How It Works</h3>
    <ul style="color: #7f8c8d; line-height: 2; padding-left: 1.5rem;">
        <li>Visitors click on any WhatsApp button on your landing page</li>
        <li>They are redirected to WhatsApp with this phone number</li>
        <li>A pre-filled message is ready for them to send</li>
        <li>You receive their message directly on your WhatsApp</li>
    </ul>
</div>

<div class="card" style="max-width: 800px; margin-top: 2rem; background: #fff3cd; border: 1px solid #ffc107;">
    <h3 style="color: #856404; margin-bottom: 1rem;">⚠️ Important Notes</h3>
    <ul style="color: #856404; line-height: 2; padding-left: 1.5rem;">
        <li>Always include the country code (e.g., +237 for Cameroon)</li>
        <li>Remove any spaces, dashes, or parentheses from the number</li>
        <li>Test the connection after saving to ensure it works</li>
        <li>The number must be a valid WhatsApp number</li>
    </ul>
</div>

<script>
    document.getElementById('testWhatsApp').addEventListener('click', async function() {
        const resultDiv = document.getElementById('testResult');
        const button = this;
        
        // Disable button during test
        button.disabled = true;
        button.textContent = '⏳ Testing...';
        
        try {
            const response = await fetch('{{ route("admin.whatsapp-settings.test") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                resultDiv.style.display = 'block';
                resultDiv.style.background = '#d4edda';
                resultDiv.style.color = '#155724';
                resultDiv.style.border = '1px solid #c3e6cb';
                resultDiv.style.padding = '1rem';
                resultDiv.style.borderRadius = '5px';
                resultDiv.innerHTML = `
                    <strong>✅ Success!</strong><br>
                    Phone Number: <code>${data.phone}</code><br>
                    <a href="${data.test_url}" target="_blank" style="color: #155724; text-decoration: underline;">
                        Click here to test on WhatsApp →
                    </a>
                `;
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            resultDiv.style.display = 'block';
            resultDiv.style.background = '#f8d7da';
            resultDiv.style.color = '#721c24';
            resultDiv.style.border = '1px solid #f5c6cb';
            resultDiv.style.padding = '1rem';
            resultDiv.style.borderRadius = '5px';
            resultDiv.innerHTML = `<strong>❌ Error:</strong> ${error.message}`;
        } finally {
            // Re-enable button
            button.disabled = false;
            button.textContent = '🧪 Test Connection';
        }
    });
</script>
@endsection
