<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::visible();

        $category = $request->string('category')->toString();
        if ($category !== '') {
            $query->where('category', $category);
        }

        $projects = $query->paginate(9)->withQueryString();
        $categories = Project::query()->where('is_active', true)->distinct()->orderBy('category')->pluck('category');

        return view('pages.projects.index', compact('projects', 'categories', 'category'));
    }

    public function show(Project $project)
    {
        abort_unless($project->is_active, 404);

        return view('pages.projects.show', compact('project'));
    }
}
