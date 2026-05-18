@extends('layouts.app')

@section('content')
    @php
        $servicesPage = $siteContent['services_page'] ?? [];
        $serviceCardCta = trim(str_replace(['->', '<-'], '', $servicesPage['card_cta'] ?? 'Discover'));
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <span class="tag">{{ $servicesPage['tag'] ?? 'Services' }}</span>
        <h1 class="section-title mt-5 max-w-4xl">{{ $servicesPage['title'] ?? 'The Twists we can give to your Plot.' }}</h1>
        <p class="mt-6 max-w-3xl">
            {{ $servicesPage['description'] ?? 'Serving both Residential and Commercial clients across all services.' }}
        </p>
    </section>

    <section class="site-shell my-16 grid gap-5 md:grid-cols-2 xl:grid-cols-3" data-reveal>
        @forelse($services as $service)
            <a href="{{ route('services.show', $service) }}" class="panel group p-7 hover-raise">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[var(--color-accent)]">{{ $service->icon ?: 'Studio' }}</p>
                <h2 class="mt-4 text-3xl text-white">{{ $service->name }}</h2>
                <p class="mt-3 text-slate-300">{{ $service->short_description }}</p>
                <p class="mt-5 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-slate-400 group-hover:text-[var(--color-accent)]">{{ $serviceCardCta }} <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i></p>
            </a>
        @empty
            <p>{{ $servicesPage['empty_text'] ?? 'No services available yet.' }}</p>
        @endforelse
    </section>
@endsection
