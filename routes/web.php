<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ContactSubmissionController;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/contact', [LandingController::class, 'storeContact'])->name('contact.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // API Settings
        Route::get('/api-settings', [App\Http\Controllers\Admin\ApiSettingController::class, 'index'])->name('api-settings.index');
        Route::post('/api-settings', [App\Http\Controllers\Admin\ApiSettingController::class, 'update'])->name('api-settings.update');
        Route::post('/api-settings/test', [App\Http\Controllers\Admin\ApiSettingController::class, 'testConnection'])->name('api-settings.test');
        
        // WhatsApp Settings
        Route::get('/whatsapp-settings', [App\Http\Controllers\Admin\WhatsAppSettingController::class, 'index'])->name('whatsapp-settings.index');
        Route::post('/whatsapp-settings', [App\Http\Controllers\Admin\WhatsAppSettingController::class, 'update'])->name('whatsapp-settings.update');
        Route::post('/whatsapp-settings/test', [App\Http\Controllers\Admin\WhatsAppSettingController::class, 'test'])->name('whatsapp-settings.test');
        
        // Services Management
        Route::resource('services', ServiceController::class);
        
        // Projects Management
        Route::resource('projects', ProjectController::class);
        Route::post('/projects/generate-ai', [ProjectController::class, 'generateWithAi'])->name('projects.generate-ai');
        Route::post('/projects/{project}/regenerate-image', [ProjectController::class, 'regenerateImage'])->name('projects.regenerate-image');
        
        // Contact Submissions
        Route::get('/contacts', [ContactSubmissionController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contactSubmission}', [ContactSubmissionController::class, 'show'])->name('contacts.show');
        Route::patch('/contacts/{contactSubmission}/status', [ContactSubmissionController::class, 'updateStatus'])->name('contacts.update-status');
        Route::delete('/contacts/{contactSubmission}', [ContactSubmissionController::class, 'destroy'])->name('contacts.destroy');
    });
});

