# 🤖 AI Integration - Ideogram Setup Guide

## ✨ What's New?

You now have **AI-Powered Project Generation** integrated into your admin panel! Instead of manually creating projects with images and descriptions, the AI does it all for you.

---

## 🚀 Features

### AI-Generated Projects Include:
1. **Professional Mockup Images** - Shows your project on devices (laptop, mobile)
2. **English Description** - Automatically generated
3. **French Description** - Automatically generated  
4. **Smart Icon Selection** - Picks the perfect emoji based on project type
5. **All in Seconds!** - No more manual work

---

## 📋 Setup Instructions

### Step 1: Get Your Ideogram API Key

1. Go to [https://ideogram.ai](https://ideogram.ai)
2. Create an account or log in
3. Navigate to the API section
4. Generate a new API key
5. Copy the API key

### Step 2: Configure in Admin Panel

1. Login to your admin panel: `http://localhost:6500/admin/login`
   - Email: `admin@devvidia.com`
   - Password: `Devvidia@2026`

2. Click on **"API Integration"** in the sidebar

3. Paste your Ideogram API key in the field

4. Click **"Save API Settings"**

### Step 3: Test AI Generation

1. Go to **Projects** section
2. Click **"Add New Project"**
3. You'll see two options:
   - **✨ AI Generation** (Recommended)
   - **📝 Manual Creation**
4. In the AI Generation section:
   - Enter a project title (e.g., "POS System for Restaurants")
   - Enter display order number
   - Click **"🚀 Generate with AI"**
5. Wait a few seconds while AI creates everything!

---

## 💡 How It Works

### Behind the Scenes:

1. **You Enter**: "POS System for Restaurants"

2. **AI Generates**:
   - **Image Prompt**: "Professional software mockup showcasing 'POS System for Restaurants'. Modern UI/UX design displayed on multiple devices..."
   - **Calls Ideogram API** to create the mockup image
   - **Downloads & Stores** the image locally
   - **Generates Descriptions** in both languages
   - **Selects Icon** (📊 for POS, 💳 for ecommerce, etc.)

3. **Result**: Complete project ready to display on your landing page!

---

## 📁 File Structure

### New Files Created:

```
app/
├── Services/
│   └── IdeogramService.php          # AI integration service
├── Http/Controllers/Admin/
│   └── ApiSettingController.php     # API settings controller
├── Models/
    └── ApiSetting.php               # API settings model

database/migrations/
├── 2026_03_19_013108_create_api_settings_table.php
└── 2026_03_19_013117_add_image_path_to_projects_table.php

resources/views/admin/
└── api-settings/
    └── index.blade.php              # API settings page

storage/app/public/
└── projects/                        # AI-generated images stored here
```

---

## 🎯 Usage Examples

### Example 1: E-commerce Platform
**Input**: "E-commerce Platform"
**AI Generates**:
- Icon: 💳
- Image: Professional mockup on devices
- Description EN: "Full-featured online marketplace with payment integration..."
- Description FR: "Plateforme de marché en ligne complète..."

### Example 2: Mobile Fitness App
**Input**: "Mobile Fitness Tracker"
**AI Generates**:
- Icon: 💪
- Image: App mockup on phone and laptop
- Description EN: "Track your fitness goals with advanced analytics..."
- Description FR: "Suivez vos objectifs de fitness avec analyses avancées..."

### Example 3: Restaurant POS
**Input**: "Restaurant Point of Sale System"
**AI Generates**:
- Icon: 📊
- Image: POS interface on tablet and computer
- Description EN: "Modern POS system designed for restaurants..."
- Description FR: "Système de point de vente moderne conçu pour restaurants..."

---

## 🔧 Technical Details

### Ideogram API Integration

**Endpoint**: `https://api.ideogram.ai/generate`

**Request Format**:
```json
{
  "image_request": {
    "prompt": "Your detailed prompt",
    "aspect_ratio": "ASPECT_16_9",
    "model": "V_2",
    "magic_prompt_option": "AUTO"
  }
}
```

**Response**: Contains generated image URL

**Process**:
1. Generate image via Ideogram API
2. Download image from URL
3. Store in `storage/app/public/projects/`
4. Save path to database
5. Display on landing page

---

## 🎨 Icon Mapping

The AI automatically selects icons based on keywords:

| Keyword | Icon | Category |
|---------|------|----------|
| pos, business | 📊 | Business |
| ecommerce, shop | 💳 | Shopping |
| messenger, chat | 💬 | Communication |
| api, backend | ⚙️ | Technical |
| security, crypto | 🔒 | Security |
| mobile, app | 📱 | Mobile |
| web, website | 🌐 | Web |
| design, creative | 🎨 | Design |
| fitness, health | 💪 | Health |
| food, restaurant | 🍔 | Food |
| delivery, logistics | 🚚 | Delivery |
| travel, booking | ✈️ | Travel |

*And 20+ more categories!*

---

## 🔐 Security

- API keys are stored encrypted in the database
- Images are stored locally (not relying on external URLs)
- File permissions set correctly for storage directory
- Admin-only access to API settings

---

## 🐛 Troubleshooting

### Issue: "Ideogram API key not configured"
**Solution**: Go to API Integration and add your API key

### Issue: Images not displaying
**Solution**: Run `php artisan storage:link` to create symbolic link

### Issue: AI generation fails
**Solutions**:
1. Check your Ideogram API key is valid
2. Ensure you have API credits
3. Check error message in the admin panel
4. Verify internet connection

### Issue: Image quality is poor
**Solution**: The prompt includes "8K quality, photorealistic" - if quality is still poor, check your Ideogram plan limits

---

## 💰 Costs

Ideogram API pricing varies by plan:
- **Free Tier**: Limited generations per month
- **Paid Plans**: Check [ideogram.ai/pricing](https://ideogram.ai/pricing)

**Tip**: Test with free tier first, upgrade if needed!

---

## 🎓 Best Practices

### Good Project Titles:
✅ "Restaurant POS System"
✅ "E-commerce Marketplace Platform"  
✅ "Mobile Fitness Tracking App"
✅ "Real Estate Property Management"

### Avoid:
❌ Single words: "POS", "App"
❌ Too generic: "Software"
❌ Too vague: "System"

**Why?** More descriptive titles = Better AI-generated content!

---

## 🔄 Future Enhancements

Potential upgrades you can add:
- [ ] Multiple image styles (minimalist, corporate, playful)
- [ ] Custom color schemes
- [ ] Video mockups
- [ ] Alternative AI providers (DALL-E, Midjourney)
- [ ] Bulk generation
- [ ] Image editing/regeneration

---

## 📞 Support

If you need help:
1. Check this documentation
2. Review error messages in admin panel
3. Check Laravel logs: `storage/logs/laravel.log`
4. Verify Ideogram API status

---

## ✅ Quick Checklist

Before using AI generation:
- [ ] Ideogram account created
- [ ] API key obtained
- [ ] API key added in admin panel  
- [ ] Storage link created (`php artisan storage:link`)
- [ ] Test with a sample project title

---

## 🎉 You're Ready!

Your AI-powered project generation system is fully set up and ready to use. Just enter a project title and let the AI do the rest!

**Happy creating! 🚀**
