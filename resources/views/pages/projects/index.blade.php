@extends('layouts.app')

@section('content')
    @php
        $projectsPage = $siteContent['projects_page'] ?? [];
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <span class="tag">{{ $projectsPage['tag'] ?? 'Portfolio' }}</span>
        <h1 class="section-title mt-5 max-w-4xl">{{ $projectsPage['title'] ?? 'Selected projects across residential and commercial typologies.' }}</h1>

        @if($categories->isNotEmpty())
            <div class="mt-8 flex flex-wrap gap-2">
                <a href="{{ route('projects.index') }}" class="rounded-full border px-4 py-2 text-xs font-semibold uppercase tracking-[0.14em] {{ $category === '' ? 'border-[var(--color-accent)] bg-[var(--color-accent)]/10 text-[var(--color-accent)]' : 'border-white/20 text-slate-400' }}">{{ $projectsPage['filter_all'] ?? 'All' }}</a>
                @foreach($categories as $item)
                    <a href="{{ route('projects.index', ['category' => $item]) }}" class="rounded-full border px-4 py-2 text-xs font-semibold uppercase tracking-[0.14em] {{ $category === $item ? 'border-[var(--color-accent)] bg-[var(--color-accent)]/10 text-[var(--color-accent)]' : 'border-white/20 text-slate-400' }}">{{ $item }}</a>
                @endforeach
            </div>
        @endif
    </section>

    <section class="site-shell my-14 grid gap-6 md:grid-cols-2 xl:grid-cols-3" data-reveal>
        @forelse($projects as $project)
            <a href="{{ route('projects.show', $project) }}" class="panel overflow-hidden hover-raise">
                <img src="{{ $project->cover_image }}" alt="{{ $project->title }}" class="h-64 w-full object-cover">
                <div class="p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">
                        {{ $project->category }}
                        @if($project->location)
                            / {{ $project->location }}
                        @endif
                    </p>
                    <h2 class="mt-3 text-3xl text-white">{{ $project->title }}</h2>
                    <p class="mt-3 text-slate-300">{{ $project->summary }}</p>
                </div>
            </a>
        @empty
            <p>{{ $projectsPage['empty_text'] ?? 'No projects available yet.' }}</p>
        @endforelse
    </section>

    @if($projects->hasPages())
        <div class="site-shell flex items-center justify-between gap-4 pb-16">
            @if($projects->onFirstPage())
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-5 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-500"><i class="fa-solid fa-arrow-left text-[10px]" aria-hidden="true"></i>{{ $projectsPage['pagination_previous'] ?? 'Previous' }}</span>
            @else
                <a href="{{ $projects->previousPageUrl() }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-300 hover:border-[var(--color-accent)] hover:text-white"><i class="fa-solid fa-arrow-left text-[10px]" aria-hidden="true"></i>{{ $projectsPage['pagination_previous'] ?? 'Previous' }}</a>
            @endif

            <span class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Page {{ $projects->currentPage() }} of {{ $projects->lastPage() }}</span>

            @if($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-300 hover:border-[var(--color-accent)] hover:text-white">{{ $projectsPage['pagination_next'] ?? 'Next' }}<i class="fa-solid fa-arrow-right text-[10px]" aria-hidden="true"></i></a>
            @else
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-5 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">{{ $projectsPage['pagination_next'] ?? 'Next' }}<i class="fa-solid fa-arrow-right text-[10px]" aria-hidden="true"></i></span>
            @endif
        </div>
    @endif
@endsection
