@extends('layouts.app')

@section('content')
    @php
        $about = $siteContent['about'] ?? [];
        $pillars = $about['pillars'] ?? [];
        $pillarIcons = [
            'fa-pen-ruler',
            'fa-cubes',
            'fa-screwdriver-wrench',
            'fa-ruler-combined',
        ];
    @endphp

    <div class="about-page">
        <div class="about-blobs" aria-hidden="true">
            <span class="about-blob about-blob-one"></span>
            <span class="about-blob about-blob-two"></span>
            <span class="about-blob about-blob-three"></span>
        </div>

        <section class="site-shell about-hero pt-16 md:pt-20" data-reveal>
            <div class="about-hero-grid">
                <div class="about-hero-copy">
                    <span class="tag">{{ $about['tag'] ?? 'Our team' }}</span>
                    <h1 class="section-title about-hero-title mt-5 max-w-4xl">{{ $about['title'] ?? 'Meet the Masterminds.' }}</h1>
                    <p class="mt-6 max-w-3xl">
                        {{ $about['description'] ?? 'Our team unites designers, architects, and builders who care about every detail.' }}
                    </p>

                    <div class="about-hero-note mt-8" data-reveal>
                        <p class="about-hero-note-tag">Design. Direct. Deliver.</p>
                        <p class="about-hero-note-copy">
                            {{ $about['hero_note'] ?? 'From first sketch to final handover, we align architecture, interiors, and execution into one clear creative system.' }}
                        </p>
                    </div>
                </div>

                <div class="about-hero-visual-wrap" data-reveal>
                    <div class="about-hero-visual">
                        <span class="about-hero-monogram" aria-hidden="true">A</span>
                        <div class="about-hero-gridlines" aria-hidden="true"></div>
                        <span class="about-hero-orb about-hero-orb-one" aria-hidden="true"></span>
                        <span class="about-hero-orb about-hero-orb-two" aria-hidden="true"></span>
                        <div class="about-hero-chip about-hero-chip-top">Premium residential + commercial studio</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="site-shell mt-16 md:mt-20" data-reveal>
            <div class="about-philosophy panel">
                <span class="about-philosophy-tag">{{ $about['philosophy_tag'] ?? 'Our philosophy' }}</span>
                <p class="about-philosophy-text">
                    {{ $about['philosophy'] ?? 'Great spaces are not decorated into existence. They are composed with intent, built with honesty, and refined until every detail feels inevitable.' }}
                </p>
            </div>
        </section>

        <section class="site-shell about-pillars mt-16" data-reveal>
            <div>
                <span class="tag">{{ $about['pillars_tag'] ?? 'What defines us' }}</span>
                <h2 class="section-title mt-4 max-w-3xl">{{ $about['pillars_title'] ?? 'Three pillars behind every project.' }}</h2>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @forelse($pillars as $index => $pillar)
                    @php
                        $icon = $pillarIcons[$index] ?? 'fa-ruler-combined';
                    @endphp
                    <article class="panel about-pillar-card h-full hover-raise" data-reveal>
                        <div class="about-pillar-top">
                            <span class="about-pillar-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="about-pillar-icon"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                        </div>
                        <h3 class="mt-6 text-2xl text-white">{{ $pillar['title'] ?? '' }}</h3>
                        <p class="mt-3 text-slate-300">{{ $pillar['desc'] ?? '' }}</p>
                    </article>
                @empty
                    <p class="text-slate-300">No pillars added yet.</p>
                @endforelse
            </div>
        </section>

        <section class="site-shell my-24" data-reveal>
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <span class="tag">{{ $about['team_tag'] ?? 'Team' }}</span>
                    <h2 class="section-title mt-4">{{ $about['team_title'] ?? 'People behind every successful build.' }}</h2>
                </div>
                <p class="max-w-2xl text-sm text-slate-300 md:text-base">
                    {{ $about['team_caption'] ?? 'A focused crew of architects, interior strategists, and project leads who move from concept to completion without losing the design intent.' }}
                </p>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @forelse($teamMembers as $member)
                    <article class="panel about-team-card" data-reveal>
                        <div class="about-team-media">
                            @if($member->photo)
                                <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="team-portrait about-team-portrait">
                            @else
                                <div class="team-portrait about-team-placeholder">{{ substr($member->name, 0, 1) }}</div>
                            @endif
                        </div>

                        <div class="p-6">
                            <div class="about-team-header">
                                <div>
                                    <p class="text-2xl text-white">{{ $member->name }}</p>
                                    <p class="mt-1 text-xs font-semibold uppercase tracking-[0.14em] text-[var(--color-accent)]">{{ $member->role }}</p>
                                </div>
                                <span class="about-team-badge"><i class="fa-solid fa-star"></i></span>
                            </div>

                            @if($member->experience_label)
                                <p class="about-team-experience mt-4">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ $member->experience_label }}</span>
                                </p>
                            @endif

                            <p class="mt-4 text-slate-300">{{ $member->bio }}</p>
                        </div>
                    </article>
                @empty
                    <p>No team members are published yet.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
