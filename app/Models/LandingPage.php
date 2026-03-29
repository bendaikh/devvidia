<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'description',
        'template',
        'is_active',
        'views',
        'submissions',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function leads()
    {
        return $this->hasMany(LeadSubmission::class, 'landing_page', 'slug');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementSubmissions()
    {
        $this->increment('submissions');
    }

    public function getConversionRateAttribute()
    {
        if ($this->views == 0) {
            return 0;
        }
        return round(($this->submissions / $this->views) * 100, 2);
    }
}
