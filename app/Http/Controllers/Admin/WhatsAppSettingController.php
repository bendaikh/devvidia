<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiSetting;
use Illuminate\Http\Request;

class WhatsAppSettingController extends Controller
{
    public function index()
    {
        $whatsappPhone = ApiSetting::get('whatsapp_phone') ?? '';
        
        return view('admin.whatsapp-settings.index', compact('whatsappPhone'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_phone' => 'required|string|max:20',
        ]);

        // Clean phone number (remove spaces, dashes, etc.)
        $cleanPhone = preg_replace('/[^0-9+]/', '', $request->whatsapp_phone);

        ApiSetting::set('whatsapp_phone', $cleanPhone);

        return redirect()->route('admin.whatsapp-settings.index')
            ->with('success', 'WhatsApp phone number updated successfully!');
    }

    public function test(Request $request)
    {
        $whatsappPhone = ApiSetting::get('whatsapp_phone');

        if (!$whatsappPhone) {
            return response()->json([
                'success' => false,
                'message' => 'WhatsApp phone number not configured.'
            ], 400);
        }

        // Test WhatsApp URL generation
        $testUrl = "https://wa.me/{$whatsappPhone}?text=Test%20message";

        return response()->json([
            'success' => true,
            'message' => 'WhatsApp phone number is valid!',
            'test_url' => $testUrl,
            'phone' => $whatsappPhone
        ]);
    }
}
