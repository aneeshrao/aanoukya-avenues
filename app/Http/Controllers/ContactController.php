<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'project_type' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        ContactSubmission::create($validated);

        $content = SiteContent::mergedContent();
        $message = $content['contact_page']['success_message'] ?? 'Thanks for reaching out. Our team will contact you shortly.';

        return back()->with('status', $message);
    }
}
