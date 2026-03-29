<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadSubmission extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'project_idea',
        'landing_page',
        'status',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    public function scopeQualified($query)
    {
        return $query->where('status', 'qualified');
    }

    public function scopeConverted($query)
    {
        return $query->where('status', 'converted');
    }

    public function scopeLost($query)
    {
        return $query->where('status', 'lost');
    }

    public function scopeByLandingPage($query, $page)
    {
        return $query->where('landing_page', $page);
    }
}
