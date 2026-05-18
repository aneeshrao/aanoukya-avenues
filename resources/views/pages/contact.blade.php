@extends('layouts.app')

@section('content')
    @php
        $contactPage = $siteContent['contact_page'] ?? [];
    @endphp

    <section class="site-shell pt-16 md:pt-20" data-reveal>
        <span class="tag">{{ $contactPage['tag'] ?? 'Contact us' }}</span>
        <h1 class="section-title mt-5 max-w-4xl">{{ $contactPage['title'] ?? 'Get in touch' }}</h1>
        <p class="mt-4 max-w-3xl text-slate-300">
            {{ $contactPage['description'] ?? 'Share your requirements and we will get back with a focused consultation roadmap.' }}
        </p>
    </section>

    <section class="site-shell my-14 grid gap-6 lg:grid-cols-[1fr_0.45fr]" data-reveal>
        <div class="panel p-8 md:p-10">
            @if(session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-500/35 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-500/35 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                    {{ $contactPage['error_message'] ?? 'Please review the highlighted fields and try again.' }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="grid gap-5">
                @csrf
                <div>
                    <label for="name" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" required>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="email" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" required>
                    </div>
                    <div>
                        <label for="phone" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Phone</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="project_type" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Project Type</label>
                    <input id="project_type" name="project_type" type="text" value="{{ old('project_type') }}" placeholder="Residential villa, Retail fit-out, etc." class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none">
                </div>

                <div>
                    <label for="message" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Message</label>
                    <textarea id="message" name="message" rows="6" class="mt-2 w-full rounded-xl border border-white/20 bg-[#0a121f] px-4 py-3 text-sm text-white focus:border-[var(--color-accent)] focus:outline-none" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-primary w-fit">{{ $contactPage['form_button'] ?? 'Send Inquiry' }}</button>
            </form>
        </div>

        <aside class="panel p-8 md:p-10">
            <h2 class="text-3xl">{{ $contactPage['studio_title'] ?? 'Studio Information' }}</h2>
            <div class="mt-6 space-y-5 text-sm text-slate-300">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $contactPage['phone_label'] ?? 'Phone' }}</p>
                    <p class="mt-1 inline-flex items-center gap-2">
                        <i class="fa-solid fa-phone text-xs text-[var(--color-accent)]" aria-hidden="true"></i>
                        <a href="tel:{{ $contactPage['phone_link'] ?? '+1023903101122' }}" class="hover:text-white">{{ $contactPage['phone_value'] ?? '+1 0239 0310 1122' }}</a>
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $contactPage['email_label'] ?? 'Email' }}</p>
                    <p class="mt-1 inline-flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-xs text-[var(--color-accent)]" aria-hidden="true"></i>
                        <a href="mailto:{{ $contactPage['email_value'] ?? 'support@gleamer.com' }}" class="hover:text-white">{{ $contactPage['email_value'] ?? 'support@gleamer.com' }}</a>
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">{{ $contactPage['address_label'] ?? 'Address' }}</p>
                    <p class="mt-1 inline-flex items-center gap-2"><i class="fa-solid fa-location-dot text-xs text-[var(--color-accent)]" aria-hidden="true"></i>{{ $contactPage['address_value'] ?? 'Blane Street, Manchester' }}</p>
                </div>
            </div>
        </aside>
    </section>
@endsection
