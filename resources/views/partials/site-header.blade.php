<header class="sticky top-0 z-40 border-b border-white/10 bg-[var(--color-cloud)]/85 backdrop-blur-xl">
    <div class="site-shell flex h-20 items-center justify-between">
        <a href="{{ route('home') }}" class="inline-flex items-center">
            <img src="{{ asset('images/logo.avif') }}" alt="{{ $siteContent['header']['logo_alt'] ?? 'Aanoukya Avenues logo' }}" class="h-12 w-auto object-contain md:h-14">
        </a>

        <button
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-slate-200 md:hidden"
            data-menu-button
            aria-expanded="false"
            aria-label="Toggle menu"
        >
            <span class="text-lg">+</span>
        </button>

        <nav class="hidden items-center gap-8 md:flex">
            <a href="{{ route('home') }}" class="site-nav-link {{ request()->routeIs('home') ? 'text-white' : '' }}">{{ $siteContent['header']['nav_home'] ?? 'Home' }}</a>
            <a href="{{ route('about') }}" class="site-nav-link {{ request()->routeIs('about') ? 'text-white' : '' }}">{{ $siteContent['header']['nav_about'] ?? 'About' }}</a>
            <a href="{{ route('services.index') }}" class="site-nav-link {{ request()->routeIs('services.*') ? 'text-white' : '' }}">{{ $siteContent['header']['nav_services'] ?? 'Services' }}</a>
            <a href="{{ route('projects.index') }}" class="site-nav-link {{ request()->routeIs('projects.*') ? 'text-white' : '' }}">{{ $siteContent['header']['nav_portfolio'] ?? 'Portfolio' }}</a>
            <a href="{{ route('contact.index') }}" class="btn-primary">{{ $siteContent['header']['cta_label'] ?? 'Get in Touch' }}</a>
        </nav>
    </div>

    <nav class="hidden border-t border-white/10 bg-[#0f141d]/95 md:hidden" data-mobile-menu>
        <div class="site-shell grid gap-4 py-5">
            <a href="{{ route('home') }}" class="site-nav-link">{{ $siteContent['header']['nav_home'] ?? 'Home' }}</a>
            <a href="{{ route('about') }}" class="site-nav-link">{{ $siteContent['header']['nav_about'] ?? 'About' }}</a>
            <a href="{{ route('services.index') }}" class="site-nav-link">{{ $siteContent['header']['nav_services'] ?? 'Services' }}</a>
            <a href="{{ route('projects.index') }}" class="site-nav-link">{{ $siteContent['header']['nav_portfolio'] ?? 'Portfolio' }}</a>
            <a href="{{ route('contact.index') }}" class="btn-primary mt-1">{{ $siteContent['header']['cta_label'] ?? 'Get in Touch' }}</a>
        </div>
    </nav>
</header>
