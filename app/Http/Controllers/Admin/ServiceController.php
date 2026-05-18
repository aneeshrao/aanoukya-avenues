<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('display_order')->paginate(12);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $validated['slug'] = $this->makeSlug($validated['slug'] ?? null, $validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('status', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validatePayload($request, $service);
        $validated['slug'] = $this->makeSlug($validated['slug'] ?? null, $validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('status', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted.');
    }

    private function validatePayload(Request $request, ?Service $service = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('services', 'slug')->ignore($service),
            ],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['required', 'string', 'max:220'],
            'description' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function makeSlug(?string $slug, string $name): string
    {
        $value = Str::slug($slug ?: $name);

        return $value !== '' ? $value : Str::slug($name).'-'.Str::random(4);
    }
}
