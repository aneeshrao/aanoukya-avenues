<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'services' => Service::count(),
            'projects' => Project::count(),
            'team_members' => TeamMember::count(),
            'testimonials' => Testimonial::count(),
            'unreplied_contacts' => ContactSubmission::whereNull('replied_at')->count(),
        ];

        $latestSubmissions = ContactSubmission::latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'latestSubmissions'));
    }
}
