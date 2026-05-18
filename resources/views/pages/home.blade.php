@extends('layouts.app')

@section('content')
    @php
        $home = $siteContent['home'] ?? [];
        $galleryImages = $home['gallery_images'] ?? [];
        $galleryReverseImages = $home['gallery_images_reverse'] ?? [];
        $marqueeItems = $home['marquee_items'] ?? [];
        $stats = $home['stats'] ?? [];
        $servicesCta = trim(str_replace(['->', '<-'], '', $home['services_cta'] ?? 'Explore all services'));
        $featuredCta = trim(str_replace(['->', '<-'], '', $home['featured_cta'] ?? 'See full portfolio'));
    @endphp

    <section class="site-shell relative overflow-hidden pt-12 md:pt-16">
        <div class="pointer-events-none absolute inset-0 blueprint-grid opacity-45"></div>
        <div class="spotlight one -left-24 top-8"></div>
        <div class="spotlight two right-0 top-28"></div>

        <div class="grid gap-12 lg:grid-cols-[1fr_0.95fr] lg:items-center">
            <div class="relative z-10" data-reveal>
                <span class="hero-kicker">{{ $home['hero_kicker'] ?? 'Aanoukya Avenues' }}</span>

                <h1 class="section-title mt-6 max-w-3xl text-5xl leading-[1.02] md:text-6xl">
                    <span class="headline-reveal"><span>{{ $home['hero_title_line_1'] ?? "We're the Twist your Plot needs." }}</span></span>
                    <br>
                    <span class="headline-reveal delay"><span class="headline-gradient">{{ $home['hero_title_line_2'] ?? "Bengaluru's End-to-End" }}</span></span>
                    <br>
                    <span class="headline-reveal delay-2"><span class="text-white">{{ $home['hero_title_line_3'] ?? 'Design + Build Studio.' }}</span></span>
                </h1>

                <p class="mt-6 max-w-2xl text-slate-300">
                    {{ $home['hero_description'] ?? 'We design, build and deliver complete homes and commercial spaces from the first sketch to the final finish. One team. Zero chaos.' }}
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('contact.index') }}" class="btn-primary">{{ $home['hero_primary_cta'] ?? 'Get Started Now' }}</a>
                    <a href="{{ route('projects.index') }}" class="btn-secondary inline-flex items-center gap-2">{{ $home['hero_secondary_cta'] ?? 'Scroll down to see projects' }} <i class="fa-solid fa-arrow-down text-xs" aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="hero-stage h-[520px]" data-reveal>
                <div class="scanline"></div>

                <svg class="wireframe-svg" viewBox="0 0 800 520" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path class="wireframe-path" d="M72 428 L310 302 L618 382 L410 492 Z" />
                    <path class="wireframe-path delay-1" d="M172 222 L418 96 L702 184 L454 304 Z" />
                    <path class="wireframe-path delay-2" d="M310 302 L310 144 L454 64 L454 304" />
                    <path class="wireframe-path delay-3" d="M618 382 L618 232 L454 304" />
                    <path class="wireframe-path delay-4" d="M72 428 L172 222 L418 96" />
                    <path class="wireframe-path delay-2" d="M172 222 L310 302 L310 144" />
                    <path class="wireframe-path delay-1" d="M454 64 L454 304 L702 184" />
                </svg>

                <div class="floating-note" style="top: 10%; left: 9%;">Facade axis</div>
                <div class="floating-note note-2" style="bottom: 21%; right: 10%;">Volume study</div>
                <div class="floating-note note-3" style="bottom: 11%; left: 40%;">Material node</div>

                <div class="orbit-ring" style="top: 18%; right: 12%;">
                    <span class="orbit-dot"></span>
                </div>
            </div>
        </div>
    </section>

    <section class="site-shell mt-16" data-reveal>
        <div class="panel grid divide-y divide-white/10 md:grid-cols-4 md:divide-x md:divide-y-0">
            @foreach($stats as $stat)
                <div class="stats-pop px-6 py-8 text-center md:px-8" style="animation-delay: {{ $loop->index * 120 }}ms;">
                    <p class="text-4xl text-white" data-stat-value="{{ $stat['value'] ?? '' }}">{{ $stat['value'] ?? '' }}</p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $stat['label'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="site-shell mt-14" data-reveal>
        <div class="mb-5 flex items-end justify-between gap-4">
            <div>
                <span class="tag">{{ $home['showcase_tag'] ?? 'Past work showcase' }}</span>
                <h2 class="mt-4 text-3xl font-semibold text-white md:text-4xl">{{ $home['showcase_title'] ?? 'Our Promise: Full-service construction and design by one team.' }}</h2>
            </div>
        </div>

        <div class="loop-gallery-mask">
            <div class="loop-gallery-track">
                @foreach($galleryImages as $image)
                    <article class="{{ $loop->odd ? 'gallery-card-pill' : 'gallery-card-wide' }}"><img src="{{ $image }}" alt="Past work image"></article>
                @endforeach
                @foreach($featuredProjects as $project)
                    <article class="{{ $loop->odd ? 'gallery-card-pill' : 'gallery-card-wide' }}"><img src="{{ $project->cover_image }}" alt="{{ $project->title }}"></article>
                @endforeach

                @foreach($galleryImages as $image)
                    <article class="{{ $loop->odd ? 'gallery-card-pill' : 'gallery-card-wide' }}" aria-hidden="true"><img src="{{ $image }}" alt="Past work image"></article>
                @endforeach
                @foreach($featuredProjects as $project)
                    <article class="{{ $loop->odd ? 'gallery-card-pill' : 'gallery-card-wide' }}" aria-hidden="true"><img src="{{ $project->cover_image }}" alt="{{ $project->title }}"></article>
                @endforeach
            </div>
        </div>

        <div class="loop-gallery-mask mt-2">
            <div class="loop-gallery-track reverse">
                @foreach($featuredProjects as $project)
                    <article class="{{ $loop->odd ? 'gallery-card-wide' : 'gallery-card-pill' }}"><img src="{{ $project->cover_image }}" alt="{{ $project->title }}"></article>
                @endforeach
                @foreach($galleryReverseImages as $image)
                    <article class="{{ $loop->odd ? 'gallery-card-wide' : 'gallery-card-pill' }}"><img src="{{ $image }}" alt="Past work image"></article>
                @endforeach

                @foreach($featuredProjects as $project)
                    <article class="{{ $loop->odd ? 'gallery-card-wide' : 'gallery-card-pill' }}" aria-hidden="true"><img src="{{ $project->cover_image }}" alt="{{ $project->title }}"></article>
                @endforeach
                @foreach($galleryReverseImages as $image)
                    <article class="{{ $loop->odd ? 'gallery-card-wide' : 'gallery-card-pill' }}" aria-hidden="true"><img src="{{ $image }}" alt="Past work image"></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-14 border-y border-white/10 bg-white/5 py-4" data-reveal>
        <div class="marquee">
            <div class="marquee-track text-xs font-semibold uppercase tracking-[0.22em] text-slate-300">
                @foreach(array_merge($marqueeItems, $marqueeItems) as $item)
                    <span>{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-shell mt-24" data-reveal>
        <div class="flex flex-wrap items-end justify-between gap-5">
            <div>
                <span class="tag">{{ $home['services_tag'] ?? 'Services' }}</span>
                <h2 class="section-title mt-4">{{ $home['services_title'] ?? 'The Twists we can give to your Plot. Serving both Residential and Commercial clients across all services.' }}</h2>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($services as $service)
                <a href="{{ route('services.show', $service) }}" class="panel group p-7 hover-raise">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[var(--color-accent)]">{{ $service->icon ?: 'Design' }}</p>
                    <h3 class="mt-4 text-3xl text-white">{{ $service->name }}</h3>
                    <p class="mt-3 text-slate-300">{{ $service->short_description }}</p>
                    <p class="mt-5 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-slate-400 group-hover:text-[var(--color-accent)]">Learn more <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i></p>
                </a>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('services.index') }}" class="section-link">{{ $servicesCta }} <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i></a>
        </div>
    </section>

    <section class="site-shell mt-24" data-reveal>
        <div class="flex flex-wrap items-end justify-between gap-5">
            <div>
                <span class="tag">{{ $home['featured_tag'] ?? 'Featured projects' }}</span>
                <h2 class="section-title mt-4">{{ $home['featured_title'] ?? 'A curated portfolio of built experiences.' }}</h2>
            </div>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-3">
            @foreach($featuredProjects as $project)
                <a href="{{ route('projects.show', $project) }}" class="panel overflow-hidden hover-raise">
                    <img src="{{ $project->cover_image }}" alt="{{ $project->title }}" class="h-64 w-full object-cover">
                    <div class="p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $project->category }} @if($project->location) / {{ $project->location }} @endif</p>
                        <h3 class="mt-3 text-3xl text-white">{{ $project->title }}</h3>
                        <p class="mt-3 text-slate-300">{{ $project->summary }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('projects.index') }}" class="section-link">{{ $featuredCta }} <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i></a>
        </div>
    </section>

    <section class="site-shell mt-24" data-reveal>
        <div class="panel p-8 md:p-10">
            <div class="flex flex-wrap items-end justify-between gap-5">
                <div>
                    <span class="tag">{{ $home['testimonials_tag'] ?? 'Testimonials' }}</span>
                    <h2 class="section-title mt-4">{{ $home['testimonials_title'] ?? 'What clients value most.' }}</h2>
                </div>
                <p class="text-sm uppercase tracking-[0.16em] text-slate-400">{{ $home['testimonials_caption'] ?? 'Trusted by homeowners and brands' }}</p>
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-3">
                @foreach($testimonials as $testimonial)
                    <article class="rounded-3xl border border-white/10 bg-[#0a1322] p-6 transition hover:border-[var(--color-accent)]/45 hover:shadow-[0_22px_45px_rgba(0,0,0,0.35)]">
                        <div class="mb-5 flex items-center gap-1 text-[var(--color-accent)]">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fa-solid fa-star text-sm" aria-hidden="true"></i>
                                @else
                                    <i class="fa-regular fa-star text-sm text-slate-500" aria-hidden="true"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="text-base leading-7 text-slate-200">"{{ $testimonial->quote }}"</p>
                        <div class="mt-6 border-t border-white/10 pt-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.12em] text-white">{{ $testimonial->client_name }}</p>
                            <p class="mt-1 text-xs uppercase tracking-[0.12em] text-slate-400">
                                {{ $testimonial->client_title ?: 'Client' }}
                                @if($testimonial->company)
                                    / {{ $testimonial->company }}
                                @endif
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-shell my-24" data-reveal>
        <div class="panel relative overflow-hidden p-10 md:p-14">
            <div class="spotlight one -right-24 -top-20"></div>
            <div class="grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <span class="tag">{{ $home['final_cta_tag'] ?? "Let's begin" }}</span>
                    <h2 class="section-title mt-5">{{ $home['final_cta_title'] ?? 'Directed by Aanoukya Avenues. Produced by Craft and Legacy.' }}</h2>
                    <p class="mt-4 max-w-xl text-slate-300">{{ $home['final_cta_description'] ?? 'Set Design by Time and Space. Written, always, by you.' }}</p>
                </div>
                <a href="{{ route('contact.index') }}" class="btn-primary">{{ $home['final_cta_button'] ?? 'Get Started Now' }}</a>
            </div>
        </div>
    </section>
@endsection
