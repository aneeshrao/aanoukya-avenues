@extends('layouts.admin', ['heading' => 'Site Content'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Site content guide',
        'text' => 'This screen controls reusable copy and labels across multiple pages. Edit carefully and save once all related text is updated.',
        'tips' => [
            'Keep approved brand tone consistent across every section.',
            'Use short, clear labels for navigation and CTA text.',
            'For major copy rewrites, review corresponding public pages after saving.',
        ],
    ])
@endsection

@section('content')
    @php
        $home = $content['home'] ?? [];
        $about = $content['about'] ?? [];
        $servicesPage = $content['services_page'] ?? [];
        $projectsPage = $content['projects_page'] ?? [];
        $contactPage = $content['contact_page'] ?? [];
        $footer = $content['footer'] ?? [];

        $marqueeItems = $home['marquee_items'] ?? [];
        $marqueeItems = array_pad($marqueeItems, 6, '');

        $stats = $home['stats'] ?? [];
        $stats = array_pad($stats, 4, ['value' => '', 'label' => '']);

        $galleryImages = array_pad($home['gallery_images'] ?? [], 4, '');
        $galleryReverseImages = array_pad($home['gallery_images_reverse'] ?? [], 4, '');

        $pillars = $about['pillars'] ?? [];
        $pillars = array_pad($pillars, 3, ['title' => '', 'desc' => '']);

        $socialLinks = $footer['social_links'] ?? [];
        $socialLinks = array_pad($socialLinks, 4, ['label' => '', 'url' => '']);
    @endphp

    <form action="{{ route('admin.site-content.update') }}" method="POST" class="grid gap-6">
        @csrf
        @method('PUT')

        <section class="admin-surface p-6">
            <h2 class="text-lg font-semibold text-slate-900">Meta + Header</h2>
            <p class="admin-muted mt-1">Controls SEO metadata and all main navigation labels.</p>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Meta Title</label>
                    <input type="text" name="content[meta][title]" value="{{ old('content.meta.title', $content['meta']['title'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Logo Alt Text</label>
                    <input type="text" name="content[header][logo_alt]" value="{{ old('content.header.logo_alt', $content['header']['logo_alt'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>
            <div class="mt-4">
                <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Meta Description</label>
                <textarea name="content[meta][description]" rows="3" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">{{ old('content.meta.description', $content['meta']['description'] ?? '') }}</textarea>
            </div>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Nav Home</label>
                    <input type="text" name="content[header][nav_home]" value="{{ old('content.header.nav_home', $content['header']['nav_home'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Nav About</label>
                    <input type="text" name="content[header][nav_about]" value="{{ old('content.header.nav_about', $content['header']['nav_about'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Nav Services</label>
                    <input type="text" name="content[header][nav_services]" value="{{ old('content.header.nav_services', $content['header']['nav_services'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Nav Portfolio</label>
                    <input type="text" name="content[header][nav_portfolio]" value="{{ old('content.header.nav_portfolio', $content['header']['nav_portfolio'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Header CTA</label>
                    <input type="text" name="content[header][cta_label]" value="{{ old('content.header.cta_label', $content['header']['cta_label'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>
        </section>

        <section class="admin-surface p-6">
            <h2 class="text-lg font-semibold text-slate-900">Home Page Copy</h2>
            <p class="admin-muted mt-1">Primary messaging shown in the hero and top sections of the homepage.</p>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero Kicker</label>
                    <input type="text" name="content[home][hero_kicker]" value="{{ old('content.home.hero_kicker', $home['hero_kicker'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero CTA Primary</label>
                    <input type="text" name="content[home][hero_primary_cta]" value="{{ old('content.home.hero_primary_cta', $home['hero_primary_cta'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero Title Line 1</label>
                    <input type="text" name="content[home][hero_title_line_1]" value="{{ old('content.home.hero_title_line_1', $home['hero_title_line_1'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero CTA Secondary</label>
                    <input type="text" name="content[home][hero_secondary_cta]" value="{{ old('content.home.hero_secondary_cta', $home['hero_secondary_cta'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero Title Line 2</label>
                    <input type="text" name="content[home][hero_title_line_2]" value="{{ old('content.home.hero_title_line_2', $home['hero_title_line_2'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero Title Line 3</label>
                    <input type="text" name="content[home][hero_title_line_3]" value="{{ old('content.home.hero_title_line_3', $home['hero_title_line_3'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>
            <div class="mt-4">
                <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Hero Description</label>
                <textarea name="content[home][hero_description]" rows="3" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">{{ old('content.home.hero_description', $home['hero_description'] ?? '') }}</textarea>
            </div>

            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Showcase Tag</label>
                    <input type="text" name="content[home][showcase_tag]" value="{{ old('content.home.showcase_tag', $home['showcase_tag'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Showcase Title</label>
                    <input type="text" name="content[home][showcase_title]" value="{{ old('content.home.showcase_title', $home['showcase_title'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Marquee Items</h3>
                <div class="mt-3 grid gap-3 md:grid-cols-2">
                    @foreach($marqueeItems as $index => $item)
                        <input type="text" name="content[home][marquee_items][{{ $index }}]" value="{{ old('content.home.marquee_items.'.$index, $item) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Marquee item {{ $index + 1 }}">
                    @endforeach
                </div>
            </div>

        </section>

        <section class="admin-surface p-6">
            <h2 class="text-lg font-semibold text-slate-900">Home Images + Highlights</h2>
            <p class="admin-muted mt-1">Image references, homepage section tags, and numeric highlight content.</p>

            <h3 class="mt-4 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Loop Gallery Images</h3>
            <div class="mt-3 grid gap-3 md:grid-cols-2">
                @foreach($galleryImages as $index => $image)
                    <input type="text" name="content[home][gallery_images][{{ $index }}]" value="{{ old('content.home.gallery_images.'.$index, $image) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Gallery image URL/path">
                @endforeach
            </div>

            <h3 class="mt-5 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Loop Gallery Reverse Images</h3>
            <div class="mt-3 grid gap-3 md:grid-cols-2">
                @foreach($galleryReverseImages as $index => $image)
                    <input type="text" name="content[home][gallery_images_reverse][{{ $index }}]" value="{{ old('content.home.gallery_images_reverse.'.$index, $image) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Reverse gallery image URL/path">
                @endforeach
            </div>

            <div class="mt-5 grid gap-4 md:grid-cols-3">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Services Tag</label>
                    <input type="text" name="content[home][services_tag]" value="{{ old('content.home.services_tag', $home['services_tag'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Services CTA</label>
                    <input type="text" name="content[home][services_cta]" value="{{ old('content.home.services_cta', $home['services_cta'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Featured Tag</label>
                    <input type="text" name="content[home][featured_tag]" value="{{ old('content.home.featured_tag', $home['featured_tag'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Services Title</label>
                    <input type="text" name="content[home][services_title]" value="{{ old('content.home.services_title', $home['services_title'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Featured Title</label>
                    <input type="text" name="content[home][featured_title]" value="{{ old('content.home.featured_title', $home['featured_title'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Featured CTA</label>
                    <input type="text" name="content[home][featured_cta]" value="{{ old('content.home.featured_cta', $home['featured_cta'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>

            <h3 class="mt-5 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Stats</h3>
            <div class="mt-3 grid gap-4">
                @foreach($stats as $index => $stat)
                    <div class="grid gap-3 md:grid-cols-2">
                        <input type="text" name="content[home][stats][{{ $index }}][value]" value="{{ old('content.home.stats.'.$index.'.value', $stat['value'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Stat value (e.g. 80+)">
                        <input type="text" name="content[home][stats][{{ $index }}][label]" value="{{ old('content.home.stats.'.$index.'.label', $stat['label'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Stat label">
                    </div>
                @endforeach
            </div>
        </section>

        <section class="admin-surface p-6">
            <h2 class="text-lg font-semibold text-slate-900">Home Testimonials + Final CTA</h2>
            <p class="admin-muted mt-1">Client proof section and final conversion message shown near homepage footer.</p>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Testimonials Tag</label>
                    <input type="text" name="content[home][testimonials_tag]" value="{{ old('content.home.testimonials_tag', $home['testimonials_tag'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Testimonials Title</label>
                    <input type="text" name="content[home][testimonials_title]" value="{{ old('content.home.testimonials_title', $home['testimonials_title'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Testimonials Caption</label>
                    <input type="text" name="content[home][testimonials_caption]" value="{{ old('content.home.testimonials_caption', $home['testimonials_caption'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>

            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Final CTA Tag</label>
                    <input type="text" name="content[home][final_cta_tag]" value="{{ old('content.home.final_cta_tag', $home['final_cta_tag'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Final CTA Button</label>
                    <input type="text" name="content[home][final_cta_button]" value="{{ old('content.home.final_cta_button', $home['final_cta_button'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                </div>
            </div>
            <div class="mt-4">
                <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Final CTA Title</label>
                <input type="text" name="content[home][final_cta_title]" value="{{ old('content.home.final_cta_title', $home['final_cta_title'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
            </div>
            <div class="mt-4">
                <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Final CTA Description</label>
                <textarea name="content[home][final_cta_description]" rows="3" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">{{ old('content.home.final_cta_description', $home['final_cta_description'] ?? '') }}</textarea>
            </div>
        </section>

        <section class="admin-surface p-6">
            <h2 class="text-lg font-semibold text-slate-900">About + Services + Projects + Contact Pages</h2>
            <p class="admin-muted mt-1">Global labels and copy snippets reused in inner pages.</p>

            <h3 class="mt-4 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">About Page</h3>
            <div class="mt-3 grid gap-4 md:grid-cols-2">
                <input type="text" name="content[about][tag]" value="{{ old('content.about.tag', $about['tag'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="About tag">
                <input type="text" name="content[about][title]" value="{{ old('content.about.title', $about['title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="About title">
                <input type="text" name="content[about][team_tag]" value="{{ old('content.about.team_tag', $about['team_tag'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Team section tag">
                <input type="text" name="content[about][team_title]" value="{{ old('content.about.team_title', $about['team_title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Team section title">
            </div>
            <div class="mt-4">
                <textarea name="content[about][description]" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="About description">{{ old('content.about.description', $about['description'] ?? '') }}</textarea>
            </div>
            <div class="mt-4 grid gap-3">
                @foreach($pillars as $index => $pillar)
                    <div class="grid gap-3 md:grid-cols-2">
                        <input type="text" name="content[about][pillars][{{ $index }}][title]" value="{{ old('content.about.pillars.'.$index.'.title', $pillar['title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Pillar title">
                        <input type="text" name="content[about][pillars][{{ $index }}][desc]" value="{{ old('content.about.pillars.'.$index.'.desc', $pillar['desc'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Pillar description">
                    </div>
                @endforeach
            </div>

            <h3 class="mt-6 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Services Page</h3>
            <div class="mt-3 grid gap-3 md:grid-cols-2">
                <input type="text" name="content[services_page][tag]" value="{{ old('content.services_page.tag', $servicesPage['tag'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Services tag">
                <input type="text" name="content[services_page][title]" value="{{ old('content.services_page.title', $servicesPage['title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Services title">
                <input type="text" name="content[services_page][description]" value="{{ old('content.services_page.description', $servicesPage['description'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Services description">
                <input type="text" name="content[services_page][card_cta]" value="{{ old('content.services_page.card_cta', $servicesPage['card_cta'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Card CTA text">
                <input type="text" name="content[services_page][show_back]" value="{{ old('content.services_page.show_back', $servicesPage['show_back'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Back text">
                <input type="text" name="content[services_page][show_cta]" value="{{ old('content.services_page.show_cta', $servicesPage['show_cta'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Service detail CTA text">
            </div>

            <h3 class="mt-6 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Projects Page</h3>
            <div class="mt-3 grid gap-3 md:grid-cols-2">
                <input type="text" name="content[projects_page][tag]" value="{{ old('content.projects_page.tag', $projectsPage['tag'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Projects tag">
                <input type="text" name="content[projects_page][title]" value="{{ old('content.projects_page.title', $projectsPage['title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Projects title">
                <input type="text" name="content[projects_page][filter_all]" value="{{ old('content.projects_page.filter_all', $projectsPage['filter_all'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Filter all text">
                <input type="text" name="content[projects_page][pagination_previous]" value="{{ old('content.projects_page.pagination_previous', $projectsPage['pagination_previous'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Pagination previous text">
                <input type="text" name="content[projects_page][pagination_next]" value="{{ old('content.projects_page.pagination_next', $projectsPage['pagination_next'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Pagination next text">
                <input type="text" name="content[projects_page][show_back]" value="{{ old('content.projects_page.show_back', $projectsPage['show_back'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Project detail back text">
                <input type="text" name="content[projects_page][show_narrative_title]" value="{{ old('content.projects_page.show_narrative_title', $projectsPage['show_narrative_title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Project narrative title">
            </div>

            <h3 class="mt-6 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Contact Page</h3>
            <div class="mt-3 grid gap-3 md:grid-cols-2">
                <input type="text" name="content[contact_page][tag]" value="{{ old('content.contact_page.tag', $contactPage['tag'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Contact tag">
                <input type="text" name="content[contact_page][title]" value="{{ old('content.contact_page.title', $contactPage['title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Contact title">
                <input type="text" name="content[contact_page][form_button]" value="{{ old('content.contact_page.form_button', $contactPage['form_button'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Form submit text">
                <input type="text" name="content[contact_page][studio_title]" value="{{ old('content.contact_page.studio_title', $contactPage['studio_title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Studio title">
                <input type="text" name="content[contact_page][phone_label]" value="{{ old('content.contact_page.phone_label', $contactPage['phone_label'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Phone label">
                <input type="text" name="content[contact_page][phone_value]" value="{{ old('content.contact_page.phone_value', $contactPage['phone_value'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Phone text">
                <input type="text" name="content[contact_page][phone_link]" value="{{ old('content.contact_page.phone_link', $contactPage['phone_link'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Phone link value (digits)">
                <input type="text" name="content[contact_page][email_label]" value="{{ old('content.contact_page.email_label', $contactPage['email_label'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Email label">
                <input type="text" name="content[contact_page][email_value]" value="{{ old('content.contact_page.email_value', $contactPage['email_value'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Email value">
                <input type="text" name="content[contact_page][address_label]" value="{{ old('content.contact_page.address_label', $contactPage['address_label'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Address label">
                <input type="text" name="content[contact_page][address_value]" value="{{ old('content.contact_page.address_value', $contactPage['address_value'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Address value">
            </div>
            <div class="mt-4 grid gap-3 md:grid-cols-2">
                <textarea name="content[contact_page][description]" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Contact description">{{ old('content.contact_page.description', $contactPage['description'] ?? '') }}</textarea>
                <textarea name="content[contact_page][success_message]" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Success message">{{ old('content.contact_page.success_message', $contactPage['success_message'] ?? '') }}</textarea>
                <textarea name="content[contact_page][error_message]" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Error message">{{ old('content.contact_page.error_message', $contactPage['error_message'] ?? '') }}</textarea>
            </div>
        </section>

        <section class="admin-surface p-6">
            <h2 class="text-lg font-semibold text-slate-900">Footer</h2>
            <p class="admin-muted mt-1">Footer headings, studio info, and social links used site-wide.</p>
            <div class="mt-4 grid gap-3 md:grid-cols-2">
                <input type="text" name="content[footer][quick_links_title]" value="{{ old('content.footer.quick_links_title', $footer['quick_links_title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Quick links heading">
                <input type="text" name="content[footer][studio_title]" value="{{ old('content.footer.studio_title', $footer['studio_title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Studio heading">
                <input type="text" name="content[footer][studio_city]" value="{{ old('content.footer.studio_city', $footer['studio_city'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="City text">
                <input type="text" name="content[footer][studio_phone]" value="{{ old('content.footer.studio_phone', $footer['studio_phone'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Phone text">
                <input type="text" name="content[footer][studio_email]" value="{{ old('content.footer.studio_email', $footer['studio_email'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Email text">
                <input type="text" name="content[footer][social_title]" value="{{ old('content.footer.social_title', $footer['social_title'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Social heading">
                <input type="text" name="content[footer][nav_contact]" value="{{ old('content.footer.nav_contact', $footer['nav_contact'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Contact nav label">
            </div>

            <div class="mt-4">
                <label class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Footer Copyright Suffix</label>
                <input type="text" name="content[footer][copyright_suffix]" value="{{ old('content.footer.copyright_suffix', $footer['copyright_suffix'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Aanoukya Avenues. Built with precision.">
            </div>

            <h3 class="mt-5 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Social Links</h3>
            <div class="mt-3 grid gap-4">
                @foreach($socialLinks as $index => $social)
                    <div class="grid gap-3 md:grid-cols-2">
                        <input type="text" name="content[footer][social_links][{{ $index }}][label]" value="{{ old('content.footer.social_links.'.$index.'.label', $social['label'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="Label (Instagram)">
                        <input type="text" name="content[footer][social_links][{{ $index }}][url]" value="{{ old('content.footer.social_links.'.$index.'.url', $social['url'] ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm" placeholder="URL">
                    </div>
                @endforeach
            </div>
        </section>

        <div class="flex justify-end">
            <button type="submit" class="admin-btn-primary">
                Save Site Content
            </button>
        </div>
    </form>
@endsection
