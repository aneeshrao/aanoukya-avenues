<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::orderBy('display_order')->paginate(12);

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $validated['slug'] = $this->makeSlug($validated['slug'] ?? null, $validated['title']);
        $validated['gallery_images'] = $this->parseGalleryImages($request->input('gallery_images'));
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validatePayload($request, $project);
        $validated['slug'] = $this->makeSlug($validated['slug'] ?? null, $validated['title']);
        $validated['gallery_images'] = $this->parseGalleryImages($request->input('gallery_images'));
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Project deleted.');
    }

    private function validatePayload(Request $request, ?Project $project = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('projects', 'slug')->ignore($project),
            ],
            'category' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'year_label' => ['nullable', 'string', 'max:20'],
            'cover_image' => ['required', 'url', 'max:2048'],
            'gallery_images' => ['nullable', 'string'],
            'project_area' => ['nullable', 'string', 'max:50'],
            'status_label' => ['nullable', 'string', 'max:50'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function parseGalleryImages(?string $images): array
    {
        if (! $images) {
            return [];
        }

        $items = preg_split('/\r\n|\r|\n/', $images) ?: [];

        return array_values(array_filter(array_map('trim', $items)));
    }

    private function makeSlug(?string $slug, string $title): string
    {
        $value = Str::slug($slug ?: $title);

        return $value !== '' ? $value : Str::slug($title).'-'.Str::random(4);
    }
}
