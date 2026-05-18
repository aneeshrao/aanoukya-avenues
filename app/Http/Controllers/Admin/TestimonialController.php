<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::orderBy('display_order')->paginate(12);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial removed.');
    }

    private function validatePayload(Request $request): array
    {
        return $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'quote' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
