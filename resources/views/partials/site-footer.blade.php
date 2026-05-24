<footer class="mt-24 border-t border-white/10 bg-[#0a0f18]/85">
    <div class="site-shell grid gap-12 py-12 md:grid-cols-3">
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center">
                <img src="{{ asset('images/logo.avif') }}" alt="{{ $siteContent['header']['logo_alt'] ?? 'Aanoukya Avenues logo' }}" class="h-14 w-auto object-contain">
            </a>
        </div>
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">{{ $siteContent['footer']['quick_links_title'] ?? 'Quick Links' }}</p>
            <div class="mt-4 grid gap-2">
                <a href="{{ route('services.index') }}" class="text-sm text-slate-300 hover:text-white">{{ $siteContent['header']['nav_services'] ?? 'Services' }}</a>
                <a href="{{ route('projects.index') }}" class="text-sm text-slate-300 hover:text-white">{{ $siteContent['header']['nav_portfolio'] ?? 'Portfolio' }}</a>
                <a href="{{ route('about') }}" class="text-sm text-slate-300 hover:text-white">{{ $siteContent['header']['nav_about'] ?? 'About' }}</a>
                <a href="{{ route('contact.index') }}" class="text-sm text-slate-300 hover:text-white">{{ $siteContent['footer']['nav_contact'] ?? 'Contact' }}</a>
            </div>
        </div>
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">{{ $siteContent['footer']['studio_title'] ?? 'Studio' }}</p>
            <div class="mt-4 space-y-2 text-sm text-slate-300">
                <p>{{ $siteContent['footer']['studio_city'] ?? 'Bengaluru, Karnataka' }}</p>
                <p>{{ $siteContent['footer']['studio_phone'] ?? '+91 98765 43210' }}</p>
                <p>{{ $siteContent['footer']['studio_email'] ?? 'hello@aanoukyaavenues.com' }}</p>
            </div>

            <p class="mt-6 text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">{{ $siteContent['footer']['social_title'] ?? 'Social' }}</p>
            <div class="mt-3 flex flex-wrap gap-3 text-sm text-slate-300">
                @foreach(($siteContent['footer']['social_links'] ?? []) as $social)
                    @if(! empty($social['label']) && ! empty($social['url']))
                        @php
                            $socialLabel = strtolower($social['label']);
                            $iconClass = match ($socialLabel) {
                                'instagram' => 'fa-brands fa-instagram',
                                'facebook' => 'fa-brands fa-facebook-f',
                                'linkedin' => 'fa-brands fa-linkedin-in',
                                'youtube' => 'fa-brands fa-youtube',
                                'x', 'twitter' => 'fa-brands fa-x-twitter',
                                default => 'fa-solid fa-arrow-up-right-from-square',
                            };
                        @endphp
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 hover:text-white">
                            <i class="{{ $iconClass }} text-xs" aria-hidden="true"></i>
                            <span>{{ $social['label'] }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-4 text-center text-xs uppercase tracking-[0.14em] text-slate-500">
        {{ date('Y') }} {{ $siteContent['footer']['copyright_suffix'] ?? 'Aanoukya Avenues. Built with precision.' }}
    </div>
</footer>

@php
    $rawWhatsappPhone = $siteContent['footer']['whatsapp_phone'] ?? $siteContent['footer']['studio_phone'] ?? '+91 98765 43210';
    $whatsappPhone = preg_replace('/\D+/', '', (string) $rawWhatsappPhone);
    $whatsappMessage = rawurlencode($siteContent['footer']['whatsapp_message'] ?? 'Hi Aanoukya Avenues, I would like to discuss my project.');
    $whatsappUrl = $whatsappPhone ? "https://wa.me/{$whatsappPhone}?text={$whatsappMessage}" : null;
@endphp

@if($whatsappUrl)
    <a
        href="{{ $whatsappUrl }}"
        class="floating-whatsapp"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat on WhatsApp"
    >
        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
    </a>
@endif
