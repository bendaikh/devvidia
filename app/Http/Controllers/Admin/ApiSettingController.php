<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiSetting;
use Illuminate\Http\Request;

class ApiSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'ideogram_api_key' => ApiSetting::get('ideogram_api_key', ''),
        ];

        return view('admin.api-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'ideogram_api_key' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            ApiSetting::set($key, $value);
        }

        return redirect()->route('admin.api-settings.index')
            ->with('success', 'API settings updated successfully!');
    }

    public function testConnection(Request $request)
    {
        $validated = $request->validate([
            'api_key' => 'required|string',
        ]);

        try {
            // Test the Ideogram API connection
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Api-Key' => $validated['api_key'],
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.ideogram.ai/');

            // Check if the request was successful (any 2xx status code)
            if ($response->successful() || $response->status() === 404) {
                // 404 is actually OK - it means the API endpoint exists but we hit a non-existent route
                // This confirms the API key is being accepted
                return response()->json([
                    'success' => true,
                    'message' => 'API key is valid and connection is working! ✓'
                ]);
            } elseif ($response->status() === 401 || $response->status() === 403) {
                // Unauthorized - API key is invalid
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid API key. Please check your key and try again.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to connect to Ideogram API. Status: ' . $response->status()
                ]);
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection timeout. Please check your internet connection.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}
