<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\ContactSubmission;
use App\Models\ApiSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class LandingController extends Controller
{
    public const LOCALES = ['fr', 'en'];

    /** Canonical (stored) project types, same order as landing.contact.types */
    public const PROJECT_TYPES = [
        'Site web', 'E-commerce', 'Application web', 'Application mobile',
        'Logiciel de gestion', 'Intégration API', 'Automatisation / IA', 'Autre',
    ];

    public function index(Request $request)
    {
        $locale = $this->resolveLocale($request);

        $services = Service::active()->ordered()->get();
        $projects = Project::active()->ordered()->get();
        $whatsappPhone = ApiSetting::get('whatsapp_phone');

        return response()
            ->view('landing', compact('services', 'projects', 'whatsappPhone', 'locale'))
            ->withCookie(Cookie::make('devvidia_lang', $locale, 60 * 24 * 365));
    }

    public function storeContact(Request $request)
    {
        $locale = in_array($request->input('locale'), self::LOCALES, true) ? $request->input('locale') : 'fr';
        App::setLocale($locale);

        // Honeypot: silently accept bots without storing anything.
        if (filled($request->input('website'))) {
            return response()->json(['success' => true, 'message' => __('landing.contact.success')]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'project_type' => ['nullable', 'string', Rule::in(self::PROJECT_TYPES)],
            'budget' => 'nullable|string|max:100',
            'project_idea' => 'required|string|max:5000',
        ], $this->messages());

        // The redesigned form always sends email + project type; make them mandatory there
        // while keeping the endpoint compatible with older clients (name/phone/project_idea).
        if ($request->has('project_type')) {
            $request->validate([
                'email' => 'required|email|max:255',
                'project_type' => ['required', Rule::in(self::PROJECT_TYPES)],
                'project_idea' => 'min:10',
            ], $this->messages());
        }

        ContactSubmission::create($validated);

        return response()->json(['success' => true, 'message' => __('landing.contact.success')]);
    }

    private function messages(): array
    {
        return [
            'required' => __('landing.contact.v_required'),
            'email' => __('landing.contact.v_email'),
            'project_idea.min' => __('landing.contact.v_min'),
            'project_type.in' => __('landing.validation.project_type'),
        ];
    }

    private function resolveLocale(Request $request): string
    {
        $locale = $request->query('lang');
        if (! in_array($locale, self::LOCALES, true)) {
            $locale = $request->cookie('devvidia_lang');
        }
        if (! in_array($locale, self::LOCALES, true)) {
            $locale = 'fr';
        }
        App::setLocale($locale);

        return $locale;
    }
}
