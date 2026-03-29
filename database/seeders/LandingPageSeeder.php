<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LandingPage::create([
            'name' => 'Systems Development',
            'slug' => 'systems',
            'title' => 'Custom System Development | Devvidia',
            'description' => 'Landing page for custom system development services including ERP, CRM, inventory management, and business automation solutions.',
            'template' => 'systems',
            'is_active' => true,
            'views' => 0,
            'submissions' => 0,
        ]);
    }
}
