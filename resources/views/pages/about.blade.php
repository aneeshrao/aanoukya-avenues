@extends('layouts.app')

@section('content')
    @php
        $about = $siteContent['about'] ?? [];
        $pillars = $about['pillars'] ?? [];
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <span class="tag">{{ $about['tag'] ?? 'Our team' }}</span>
        <h1 class="section-title mt-5 max-w-4xl">{{ $about['title'] ?? 'Meet the Masterminds.' }}</h1>
        <p class="mt-6 max-w-3xl">
            {{ $about['description'] ?? 'Our team unites designers, architects, and builders who care about every detail.' }}
        </p>
    </section>

    <section class="site-shell mt-16" data-reveal>
        <div class="grid gap-6 md:grid-cols-3">
            @foreach($pillars as $pillar)
                <div class="panel p-7 hover-raise">
                    <h2 class="text-3xl text-white">{{ $pillar['title'] ?? '' }}</h2>
                    <p class="mt-3 text-slate-300">{{ $pillar['desc'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="site-shell my-24" data-reveal>
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="tag">{{ $about['team_tag'] ?? 'Team' }}</span>
                <h2 class="section-title mt-4">{{ $about['team_title'] ?? 'People behind every successful build.' }}</h2>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse($teamMembers as $member)
                <article class="panel overflow-hidden hover-raise">
                    @if($member->photo)
                        <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="team-portrait">
                    @endif
                    <div class="p-6">
                        <p class="text-3xl text-white">{{ $member->name }}</p>
                        <p class="mt-1 text-xs font-semibold uppercase tracking-[0.14em] text-[var(--color-accent)]">{{ $member->role }}</p>
                        @if($member->experience_label)
                            <p class="mt-3 text-xs font-semibold uppercase tracking-[0.12em] text-slate-400">{{ $member->experience_label }}</p>
                        @endif
                        <p class="mt-3 text-slate-300">{{ $member->bio }}</p>
                    </div>
                </article>
            @empty
                <p>No team members are published yet.</p>
            @endforelse
        </div>
    </section>
@endsection
