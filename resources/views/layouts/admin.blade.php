<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Admin | Aanoukya Avenues' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-body min-h-screen">
        @php
            $navItems = [
                [
                    'label' => 'Dashboard',
                    'description' => 'Overview and quick action links.',
                    'route' => 'admin.dashboard',
                    'active' => 'admin.dashboard',
                ],
                [
                    'label' => 'Services',
                    'description' => 'Manage service cards and display order.',
                    'route' => 'admin.services.index',
                    'active' => 'admin.services.*',
                ],
                [
                    'label' => 'Projects',
                    'description' => 'Update portfolio entries and featured projects.',
                    'route' => 'admin.projects.index',
                    'active' => 'admin.projects.*',
                ],
                [
                    'label' => 'Team Members',
                    'description' => 'Edit profile cards shown on About page.',
                    'route' => 'admin.team-members.index',
                    'active' => 'admin.team-members.*',
                ],
                [
                    'label' => 'Testimonials',
                    'description' => 'Manage client quotes and ratings.',
                    'route' => 'admin.testimonials.index',
                    'active' => 'admin.testimonials.*',
                ],
                [
                    'label' => 'Users',
                    'description' => 'Create team logins and admin access.',
                    'route' => 'admin.users.index',
                    'active' => 'admin.users.*',
                ],
                [
                    'label' => 'Site Content',
                    'description' => 'Edit global copy used across all pages.',
                    'route' => 'admin.site-content.edit',
                    'active' => 'admin.site-content.*',
                ],
                [
                    'label' => 'Contact Inbox',
                    'description' => 'Track incoming leads and reply status.',
                    'route' => 'admin.contacts.index',
                    'active' => 'admin.contacts.*',
                ],
            ];

            $currentSection = collect($navItems)->first(fn ($item) => request()->routeIs($item['active']));
        @endphp

        <div class="admin-shell flex min-h-screen">
            <aside class="admin-sidebar hidden w-[19rem] p-6 lg:flex lg:flex-col">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex flex-col">
                    <span class="font-serif text-3xl text-white">Aanoukya</span>
                    <span class="mt-1 text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Content Console</span>
                </a>
                <p class="mt-4 text-xs leading-5 text-slate-400">
                    Keep site content fresh. Every save updates the live pages immediately.
                </p>

                <nav class="mt-8 grid gap-2">
                    @foreach($navItems as $item)
                        @php($isActive = request()->routeIs($item['active']))
                        <a href="{{ route($item['route']) }}" class="admin-nav-link {{ $isActive ? 'is-active' : '' }}">
                            <span class="font-semibold">{{ $item['label'] }}</span>
                            <span class="text-[11px] tracking-[0.04em] text-slate-400">{{ $item['description'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </aside>

            <div class="flex-1 p-4 md:p-8">
                <header class="admin-surface mb-6 p-5 md:p-6">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-slate-400">Admin Section</p>
                            <h1 class="mt-2 text-2xl font-semibold text-slate-800 md:text-3xl">{{ $heading ?? 'Admin' }}</h1>
                            <p class="mt-2 text-sm text-slate-500">{{ $currentSection['description'] ?? 'Manage your website content from this dashboard.' }}</p>
                        </div>

                        @auth
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="admin-btn-secondary">Logout</button>
                            </form>
                        @endauth
                    </div>

                    <div class="mt-4 flex gap-2 overflow-x-auto pb-1 lg:hidden">
                        @foreach($navItems as $item)
                            @php($isActive = request()->routeIs($item['active']))
                            <a href="{{ route($item['route']) }}" class="shrink-0 rounded-full border px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] {{ $isActive ? 'border-orange-300 bg-orange-100 text-[#8e4317]' : 'border-slate-300 bg-white text-slate-600' }}">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </header>

                @if(session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        Please correct the highlighted fields and try again.
                    </div>
                @endif

                @hasSection('page_help')
                    <div class="mb-6">
                        @yield('page_help')
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </body>
</html>
