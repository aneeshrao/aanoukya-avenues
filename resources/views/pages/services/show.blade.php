@extends('layouts.app')

@section('content')
    @php
        $servicesPage = $siteContent['services_page'] ?? [];
        $servicesBack = trim(str_replace(['->', '<-'], '', $servicesPage['show_back'] ?? 'Back to services'));
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-slate-400 hover:text-white"><i class="fa-solid fa-arrow-left text-xs" aria-hidden="true"></i>{{ $servicesBack }}</a>
        <div class="mt-5 max-w-4xl">
            <span class="tag">{{ $service->icon ?: 'Service' }}</span>
            <h1 class="section-title mt-5">{{ $service->name }}</h1>
            <p class="mt-4 text-lg text-slate-300">{{ $service->short_description }}</p>
        </div>
    </section>

    <section class="site-shell my-14" data-reveal>
        <div class="panel p-8 md:p-10">
            <div class="max-w-4xl leading-8 text-slate-300">
                {!! nl2br(e($service->description)) !!}
            </div>
            <div class="mt-8 border-t border-white/10 pt-8">
                <a href="{{ route('contact.index') }}" class="btn-primary">{{ $servicesPage['show_cta'] ?? 'Discuss This Service' }}</a>
            </div>
        </div>
    </section>
@endsection
