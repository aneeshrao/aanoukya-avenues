<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::visible()->take(3)->get();
        $featuredProjects = Project::featured()->take(3)->get();
        $testimonials = Testimonial::visible()->take(3)->get();

        return view('pages.home', compact('services', 'featuredProjects', 'testimonials'));
    }

    public function about()
    {
        $teamMembers = TeamMember::visible()->get();

        return view('pages.about', compact('teamMembers'));
    }
}
