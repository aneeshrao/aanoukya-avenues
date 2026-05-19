<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $services = Service::visible()->take(3)->get();
            $featuredProjects = Project::featured()->take(3)->get();
            $testimonials = Testimonial::visible()->take(3)->get();
        } catch (QueryException) {
            $services = new Collection();
            $featuredProjects = new Collection();
            $testimonials = new Collection();
        }

        return view('pages.home', compact('services', 'featuredProjects', 'testimonials'));
    }

    public function about()
    {
        try {
            $teamMembers = TeamMember::visible()->get();
        } catch (QueryException) {
            $teamMembers = new Collection();
        }

        return view('pages.about', compact('teamMembers'));
    }
}
