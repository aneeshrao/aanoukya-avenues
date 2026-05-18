<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactSubmissionController extends Controller
{
    public function index(): View
    {
        $submissions = ContactSubmission::latest()->paginate(20);

        return view('admin.contacts.index', compact('submissions'));
    }

    public function markReplied(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->update([
            'replied_at' => now(),
        ]);

        return back()->with('status', 'Submission marked as replied.');
    }
}
