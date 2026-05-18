<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Admin | Aanoukya Avenues' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <div class="flex min-h-screen">
            <aside class="hidden w-72 border-r border-slate-200 bg-white p-6 lg:block">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex flex-col">
                    <span class="font-serif text-3xl text-[var(--color-ink-soft)]">Aanoukya</span>
                    <span class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Admin Panel</span>
                </a>

                <nav class="mt-10 grid gap-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-100 font-semibold' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.services.index') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.services.*') ? 'bg-slate-100 font-semibold' : '' }}">Services</a>
                    <a href="{{ route('admin.projects.index') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.projects.*') ? 'bg-slate-100 font-semibold' : '' }}">Projects</a>
                    <a href="{{ route('admin.team-members.index') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.team-members.*') ? 'bg-slate-100 font-semibold' : '' }}">Team Members</a>
                    <a href="{{ route('admin.testimonials.index') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.testimonials.*') ? 'bg-slate-100 font-semibold' : '' }}">Testimonials</a>
                    <a href="{{ route('admin.site-content.edit') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.site-content.*') ? 'bg-slate-100 font-semibold' : '' }}">Site Content</a>
                    <a href="{{ route('admin.contacts.index') }}" class="rounded-lg px-3 py-2 hover:bg-slate-100 {{ request()->routeIs('admin.contacts.*') ? 'bg-slate-100 font-semibold' : '' }}">Contact Inbox</a>
                </nav>
            </aside>

            <div class="flex-1 p-4 md:p-8">
                <header class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h1 class="text-2xl font-semibold text-slate-800">{{ $heading ?? 'Admin' }}</h1>
                    @auth
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-700 hover:bg-slate-200">Logout</button>
                        </form>
                    @endauth
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

                @yield('content')
            </div>
        </div>
    </body>
</html>
