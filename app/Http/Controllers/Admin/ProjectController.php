<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\IdeogramService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::ordered()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:10',
            'image_path' => 'nullable|string',
            'name' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_fr' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function generateWithAi(Request $request)
    {
        $validated = $request->validate([
            'project_title' => 'required|string|max:255',
        ]);

        try {
            // Get the next order number automatically
            $nextOrder = Project::max('order') + 1;

            $ideogramService = new IdeogramService();
            $aiData = $ideogramService->generateProject($validated['project_title']);

            $project = Project::create([
                'name' => $validated['project_title'],
                'icon' => $aiData['icon'],
                'image_path' => $aiData['image_path'],
                'description_en' => $aiData['description_en'],
                'description_fr' => $aiData['description_fr'],
                'order' => $nextOrder,
                'is_active' => true,
            ]);

            return redirect()->route('admin.projects.index')
                ->with('success', 'Project generated successfully with AI!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'AI Generation failed: ' . $e->getMessage());
        }
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:10',
            'image_path' => 'nullable|string',
            'name' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_fr' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }

    public function regenerateImage(Request $request, Project $project)
    {
        try {
            $ideogramService = new IdeogramService();
            
            // Generate new image with enhanced prompt
            $aiData = $ideogramService->regenerateImage($project->name);

            // Update only the image
            $project->update([
                'image_path' => $aiData['image_path'],
            ]);

            return redirect()->route('admin.projects.index')
                ->with('success', 'Project image regenerated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Image regeneration failed: ' . $e->getMessage());
        }
    }
}

