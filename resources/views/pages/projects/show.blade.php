@extends('layouts.app')

@section('content')
    @php
        $projectsPage = $siteContent['projects_page'] ?? [];
        $projectsBack = trim(str_replace(['->', '<-'], '', $projectsPage['show_back'] ?? 'Back to portfolio'));
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-slate-400 hover:text-white"><i class="fa-solid fa-arrow-left text-xs" aria-hidden="true"></i>{{ $projectsBack }}</a>

        <div class="mt-5 grid gap-10 lg:grid-cols-[1fr_0.35fr] lg:items-end">
            <div>
                <span class="tag">{{ $project->category }}</span>
                <h1 class="section-title mt-5">{{ $project->title }}</h1>
                <p class="mt-4 max-w-3xl text-lg text-slate-300">{{ $project->summary }}</p>
            </div>

            <div class="panel grid gap-3 p-5 text-sm text-slate-300">
                @if($project->location)
                    <p><span class="font-semibold text-slate-400">Location:</span> {{ $project->location }}</p>
                @endif
                @if($project->project_area)
                    <p><span class="font-semibold text-slate-400">Area:</span> {{ $project->project_area }}</p>
                @endif
                @if($project->year_label)
                    <p><span class="font-semibold text-slate-400">Year:</span> {{ $project->year_label }}</p>
                @endif
                @if($project->status_label)
                    <p><span class="font-semibold text-slate-400">Status:</span> {{ $project->status_label }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="site-shell mt-10" data-reveal>
        <img src="{{ $project->cover_image }}" alt="{{ $project->title }}" class="h-[520px] w-full rounded-3xl object-cover">
    </section>

    @if($project->gallery_images && count($project->gallery_images) > 0)
        <section class="site-shell mt-8 grid gap-5 md:grid-cols-2" data-reveal>
            @foreach($project->gallery_images as $image)
                <img src="{{ $image }}" alt="{{ $project->title }} gallery image {{ $loop->iteration }}" class="h-80 w-full rounded-2xl object-cover">
            @endforeach
        </section>
    @endif

    <section class="site-shell my-16" data-reveal>
        <div class="panel p-8 md:p-10">
            <h2 class="text-4xl">{{ $projectsPage['show_narrative_title'] ?? 'Project narrative' }}</h2>
            <div class="mt-6 max-w-4xl leading-8 text-slate-300">
                {!! nl2br(e($project->description)) !!}
            </div>
        </div>
    </section>
@endsection
