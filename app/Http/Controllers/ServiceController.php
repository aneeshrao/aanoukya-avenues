<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::visible()->get();

        return view('pages.services.index', compact('services'));
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        return view('pages.services.show', compact('service'));
    }
}
