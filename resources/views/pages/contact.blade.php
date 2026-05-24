@extends('layouts.app')

@section('meta_title', ($siteContent['contact_page']['title'] ?? 'Contact Aanoukya Avenues').' | Aanoukya Avenues')
@section('meta_description', $siteContent['contact_page']['description'] ?? 'Connect with Aanoukya Avenues for residential and commercial design-build consultations.')

@section('content')
    @php
        $contactPage = $siteContent['contact_page'] ?? [];
        $footer = $siteContent['footer'] ?? [];

        $phoneValue = $contactPage['phone_value'] ?? ($footer['studio_phone'] ?? '+91 98765 43210');
        $phoneLink = $contactPage['phone_link'] ?? preg_replace('/\s+/', '', $phoneValue);
        $emailValue = $contactPage['email_value'] ?? ($footer['studio_email'] ?? 'hello@aanoukyaavenues.com');
        $addressValue = $contactPage['address_value'] ?? ($footer['studio_city'] ?? 'Bengaluru, Karnataka');
        $mapQuery = trim((string) ($contactPage['map_query'] ?? $addressValue));
        $mapEmbedUrl = trim((string) ($contactPage['map_embed_url'] ?? ''));

        if ($mapEmbedUrl === '' && $mapQuery !== '') {
            $mapEmbedUrl = 'https://www.google.com/maps?q='.urlencode($mapQuery).'&output=embed';
        }

        $mapOpenUrl = $mapQuery !== ''
            ? 'https://www.google.com/maps/search/?api=1&query='.urlencode($mapQuery)
            : '';
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <span class="tag">{{ $contactPage['tag'] ?? 'Contact us' }}</span>
        <h1 class="section-title mt-5 max-w-4xl">{{ $contactPage['title'] ?? 'Get in touch' }}</h1>
        <p class="mt-4 max-w-3xl text-slate-300">
            {{ $contactPage['description'] ?? 'Share your requirements and we will get back with a focused consultation roadmap.' }}
        </p>
    </section>

    <section class="site-shell contact-layout my-14 grid gap-6 lg:grid-cols-[1fr_0.45fr]" data-reveal>
        <div class="contact-ambient" aria-hidden="true">
            <span class="contact-ambient-orb one" data-parallax="28"></span>
            <span class="contact-ambient-orb two" data-parallax="34"></span>
        </div>

        <div class="panel contact-form-panel p-8 md:p-10">
            @if(session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-500/35 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-500/35 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                    {{ $contactPage['error_message'] ?? 'Please review the highlighted fields and try again.' }}
                </div>
            @endif

            <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="grid gap-5" data-contact-form novalidate>
                @csrf
                <div>
                    <label for="name" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" data-contact-input required>
                    <p class="contact-field-error" data-field-error="name"></p>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="email" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" data-contact-input required>
                        <p class="contact-field-error" data-field-error="email"></p>
                    </div>
                    <div>
                        <label for="phone" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Phone</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" data-contact-input>
                        <p class="contact-field-error" data-field-error="phone"></p>
                    </div>
                </div>

                <div>
                    <label for="project_type" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Project Type</label>
                    <input id="project_type" name="project_type" type="text" value="{{ old('project_type') }}" placeholder="Residential villa, Retail fit-out, etc." class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" data-contact-input>
                    <p class="contact-field-error" data-field-error="project_type"></p>
                </div>

                <div>
                    <label for="message" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Message</label>
                    <textarea id="message" name="message" rows="6" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" data-contact-input required>{{ old('message') }}</textarea>
                    <p class="contact-field-error" data-field-error="message"></p>
                </div>

                <button type="submit" class="btn-primary w-fit" data-contact-submit data-default-label="{{ $contactPage['form_button'] ?? 'Send Inquiry' }}">{{ $contactPage['form_button'] ?? 'Send Inquiry' }}</button>
            </form>

            <div class="contact-success-card mt-6 hidden" data-contact-success>
                <div class="contact-success-icon" aria-hidden="true">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3 class="mt-3 text-2xl text-white">Thank you. We have your request.</h3>
                <p class="mt-2 text-slate-300" data-contact-success-message>{{ $contactPage['success_message'] ?? 'Thanks for reaching out. Our team will contact you shortly.' }}</p>
                <button type="button" class="btn-secondary mt-5" data-contact-reset>Send another inquiry</button>
            </div>
        </div>

        <aside class="panel contact-info-panel p-8 md:p-10">
            <h2 class="text-3xl">{{ $contactPage['studio_title'] ?? 'Studio Information' }}</h2>
            <div class="mt-6 space-y-5 text-sm text-slate-300">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $contactPage['phone_label'] ?? 'Phone' }}</p>
                    <p class="mt-1 inline-flex items-center gap-2">
                        <i class="fa-solid fa-phone text-xs text-[var(--color-accent)]" aria-hidden="true"></i>
                        <a href="tel:{{ $phoneLink }}" class="hover:text-white">{{ $phoneValue }}</a>
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $contactPage['email_label'] ?? 'Email' }}</p>
                    <p class="mt-1 inline-flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-xs text-[var(--color-accent)]" aria-hidden="true"></i>
                        <a href="mailto:{{ $emailValue }}" class="hover:text-white">{{ $emailValue }}</a>
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $contactPage['address_label'] ?? 'Address' }}</p>
                    <p class="mt-1 inline-flex items-center gap-2"><i class="fa-solid fa-location-dot text-xs text-[var(--color-accent)]" aria-hidden="true"></i>{{ $addressValue }}</p>
                </div>

                @if($mapEmbedUrl)
                    <div class="pt-2">
                        <div class="contact-map-frame">
                            <iframe
                                src="{{ $mapEmbedUrl }}"
                                title="Studio location map"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                            ></iframe>
                        </div>

                        @if($mapOpenUrl)
                            <a href="{{ $mapOpenUrl }}" target="_blank" rel="noopener noreferrer" class="contact-map-link">
                                Open in Google Maps
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </aside>
    </section>
@endsection
