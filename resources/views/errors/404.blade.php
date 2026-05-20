@extends('layouts.app')

@section('meta_title', 'Page Not Found | Aanoukya Avenues')
@section('meta_description', 'The page you requested was not found. Continue exploring Aanoukya Avenues architecture and construction services.')

@section('content')
    <section class="site-shell my-24 md:my-32">
        <div class="panel relative overflow-hidden px-6 py-12 text-center md:px-12 md:py-16">
            <div class="spotlight one -right-16 -top-14" aria-hidden="true"></div>
            <p class="text-[5rem] font-extrabold leading-none tracking-tight text-white md:text-[7rem]">
                <span class="headline-gradient">404</span>
            </p>
            <h1 class="mt-4 text-4xl text-white md:text-5xl">Page not found</h1>
            <p class="mx-auto mt-4 max-w-2xl text-slate-300">
                The page you are looking for does not exist or may have moved. Continue browsing our projects, services, and studio story.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="btn-primary">Return Home</a>
                <a href="{{ route('projects.index') }}" class="btn-secondary">View Projects</a>
            </div>
        </div>
    </section>
@endsection
