<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->orderByDesc('is_admin')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('status', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $nextIsAdmin = $request->boolean('is_admin');

        if ($this->cannotRemoveAdminAccess($request, $user, $nextIsAdmin)) {
            return back()->withErrors([
                'is_admin' => 'At least one admin account is required. You also cannot remove admin access from your own account.',
            ])->withInput();
        }

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $nextIsAdmin,
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = $validated['password'];
        }

        $user->update($payload);

        return redirect()->route('admin.users.index')->with('status', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()?->is($user)) {
            return back()->withErrors([
                'email' => 'You cannot delete your own account while logged in.',
            ]);
        }

        if ($user->is_admin && ! User::where('is_admin', true)->whereKeyNot($user->id)->exists()) {
            return back()->withErrors([
                'email' => 'At least one admin account is required.',
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User removed successfully.');
    }

    private function cannotRemoveAdminAccess(Request $request, User $user, bool $nextIsAdmin): bool
    {
        if (! $user->is_admin || $nextIsAdmin) {
            return false;
        }

        if ($request->user()?->is($user)) {
            return true;
        }

        return ! User::where('is_admin', true)->whereKeyNot($user->id)->exists();
    }
}
