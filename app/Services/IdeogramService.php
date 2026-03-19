<?php

namespace App\Services;

use App\Models\ApiSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IdeogramService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.ideogram.ai/';

    public function __construct()
    {
        $this->apiKey = ApiSetting::get('ideogram_api_key');
    }

    /**
     * Generate a project image and description using Ideogram AI
     */
    public function generateProject($projectTitle)
    {
        if (!$this->apiKey) {
            throw new \Exception('Ideogram API key not configured. Please add it in API Settings.');
        }

        // Step 1: Generate the project mockup image
        $imagePrompt = $this->buildImagePrompt($projectTitle);
        $imageData = $this->generateImage($imagePrompt);

        // Step 2: Generate project descriptions
        $descriptions = $this->generateDescriptions($projectTitle);

        // Step 3: Generate an appropriate icon/emoji
        $icon = $this->generateIcon($projectTitle);

        return [
            'image_url' => $imageData['url'] ?? null,
            'image_path' => $imageData['path'] ?? null,
            'icon' => $icon,
            'description_en' => $descriptions['en'],
            'description_fr' => $descriptions['fr'],
        ];
    }

    /**
     * Regenerate only the image with enhanced prompt
     */
    public function regenerateImage($projectTitle)
    {
        if (!$this->apiKey) {
            throw new \Exception('Ideogram API key not configured. Please add it in API Settings.');
        }

        // Use enhanced prompt for better results
        $imagePrompt = $this->buildEnhancedImagePrompt($projectTitle);
        $imageData = $this->generateImage($imagePrompt);

        return [
            'image_url' => $imageData['url'] ?? null,
            'image_path' => $imageData['path'] ?? null,
        ];
    }

    /**
     * Build a detailed prompt for image generation
     */
    protected function buildImagePrompt($projectTitle)
    {
        return "Professional software mockup showcasing '{$projectTitle}'. Modern UI/UX design displayed on multiple devices (laptop and mobile phone). High-quality, clean design with a tech-focused aesthetic. Blue and white color scheme. Realistic device mockups. Professional business presentation style. 8K quality, photorealistic.";
    }

    /**
     * Build an enhanced image generation prompt for regeneration
     * This creates different variations to get better results
     */
    protected function buildEnhancedImagePrompt($projectTitle)
    {
        $variations = [
            "Premium luxury UI design for '{$projectTitle}' application. Stunning dark mode interface with vibrant gradient colors, glassmorphism effects, modern card layouts, and sophisticated visual hierarchy. Displayed on MacBook Pro and iPhone mockups with dramatic studio lighting. Award-winning interface design. 8K quality, ultra realistic.",
            
            "Futuristic innovative interface for '{$projectTitle}'. Bright airy layout with bold typography, vibrant illustrations, smooth color transitions, 3D elements, and delightful UX details. Professional device mockups with soft shadows and ambient lighting. Modern, user-centric design. Photorealistic, high-end quality.",
            
            "Elite high-end dashboard for '{$projectTitle}'. Immersive interface with data visualizations, charts, elegant spacing, premium purple and blue gradient palette, refined micro-interactions. Sleek laptop and mobile mockups with studio presentation. Sophisticated enterprise-grade design. 8K photorealistic render.",
            
            "Creative stunning UI for '{$projectTitle}' app. Colorful gradient background, modern minimalist interface, smooth animations representation, floating cards, beautiful icons, contemporary typography. Multiple device mockups (desktop, tablet, mobile) with professional lighting. Next-generation design. Ultra HD quality.",
            
            "Professional sleek interface for '{$projectTitle}'. Clean white background with vibrant accent colors, clear navigation, intuitive layout, modern components, subtle shadows and depth. Realistic device mockups with perfect lighting. Business-focused, premium quality design. 8K photorealistic.",
        ];

        // Randomly select a variation for different results each time
        return $variations[array_rand($variations)];
    }

    /**
     * Generate image using Ideogram API
     */
    protected function generateImage($prompt)
    {
        try {
            $response = Http::withHeaders([
                'Api-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . 'generate', [
                'image_request' => [
                    'prompt' => $prompt,
                    'aspect_ratio' => 'ASPECT_16_9',
                    'model' => 'V_2',
                    'magic_prompt_option' => 'AUTO',
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Get the generated image URL
                $imageUrl = $data['data'][0]['url'] ?? null;
                
                if ($imageUrl) {
                    // Download and store the image
                    $imagePath = $this->downloadAndStoreImage($imageUrl);
                    
                    return [
                        'url' => $imageUrl,
                        'path' => $imagePath,
                    ];
                }
            }

            throw new \Exception('Failed to generate image: ' . $response->body());
        } catch (\Exception $e) {
            throw new \Exception('Image generation failed: ' . $e->getMessage());
        }
    }

    /**
     * Download image from URL and store locally
     */
    protected function downloadAndStoreImage($imageUrl)
    {
        try {
            $imageContent = file_get_contents($imageUrl);
            $filename = 'projects/' . Str::random(40) . '.png';
            
            Storage::disk('public')->put($filename, $imageContent);
            
            return $filename;
        } catch (\Exception $e) {
            throw new \Exception('Failed to download image: ' . $e->getMessage());
        }
    }

    /**
     * Generate project descriptions in English and French
     */
    protected function generateDescriptions($projectTitle)
    {
        // For now, using Ideogram's describe API or a simple template
        // You can enhance this with a separate AI service
        
        $prompt = "Generate a professional, concise project description (max 150 characters) for: {$projectTitle}";
        
        // Simplified version - you can integrate with another AI for better descriptions
        $descriptionEn = $this->generateTextWithIdeogram($prompt . " in English");
        $descriptionFr = $this->generateTextWithIdeogram($prompt . " in French");

        return [
            'en' => $descriptionEn ?: "Professional {$projectTitle} solution with cutting-edge technology and modern design.",
            'fr' => $descriptionFr ?: "Solution professionnelle {$projectTitle} avec technologie de pointe et design moderne.",
        ];
    }

    /**
     * Generate text using Ideogram (if supported) or use templates
     */
    protected function generateTextWithIdeogram($prompt)
    {
        // Ideogram is primarily for images, so we'll use a simple template approach
        // You can integrate OpenAI/Claude here for better text generation
        return null;
    }

    /**
     * Generate an appropriate icon/emoji for the project
     */
    protected function generateIcon($projectTitle)
    {
        $keywords = strtolower($projectTitle);
        
        $iconMap = [
            'pos' => '📊',
            'ecommerce' => '💳',
            'shop' => '🛒',
            'messenger' => '💬',
            'chat' => '💬',
            'api' => '⚙️',
            'security' => '🔒',
            'crypto' => '🔒',
            'mobile' => '📱',
            'web' => '🌐',
            'desktop' => '🖥️',
            'design' => '🎨',
            'photo' => '📸',
            'video' => '🎬',
            'music' => '🎵',
            'game' => '🎮',
            'education' => '📚',
            'health' => '🏥',
            'fitness' => '💪',
            'food' => '🍔',
            'delivery' => '🚚',
            'travel' => '✈️',
            'hotel' => '🏨',
            'real estate' => '🏠',
            'car' => '🚗',
            'finance' => '💰',
            'banking' => '🏦',
            'insurance' => '🛡️',
            'social' => '👥',
            'dating' => '💕',
            'news' => '📰',
            'weather' => '🌤️',
            'calendar' => '📅',
            'task' => '✅',
            'productivity' => '📈',
        ];

        foreach ($iconMap as $keyword => $icon) {
            if (str_contains($keywords, $keyword)) {
                return $icon;
            }
        }

        return '💼'; // Default business icon
    }
}
