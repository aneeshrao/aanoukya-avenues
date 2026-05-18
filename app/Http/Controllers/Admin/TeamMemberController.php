<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        $teamMembers = TeamMember::orderBy('display_order')->paginate(12);

        return view('admin.team-members.index', compact('teamMembers'));
    }

    public function create(): View
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $validated['bio'] = trim((string) ($validated['bio'] ?? ''));
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        TeamMember::create($validated);

        return redirect()->route('admin.team-members.index')->with('status', 'Team member added.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $validated['bio'] = trim((string) ($validated['bio'] ?? ''));
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        $teamMember->update($validated);

        return redirect()->route('admin.team-members.index')->with('status', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')->with('status', 'Team member removed.');
    }

    private function validatePayload(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'string', 'max:2048'],
            'experience_label' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
