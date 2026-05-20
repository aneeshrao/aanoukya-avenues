@extends('layouts.app')

@section('meta_title', 'Server Error | Aanoukya Avenues')
@section('meta_description', 'Something went wrong while loading this page. Please try again or return to Aanoukya Avenues home page.')

@section('content')
    <section class="site-shell my-24 md:my-32">
        <div class="panel relative overflow-hidden px-6 py-12 text-center md:px-12 md:py-16">
            <div class="spotlight two -left-20 top-0" aria-hidden="true"></div>
            <p class="text-[5rem] font-extrabold leading-none tracking-tight text-white md:text-[7rem]">
                <span class="headline-gradient">500</span>
            </p>
            <h1 class="mt-4 text-4xl text-white md:text-5xl">Something went wrong</h1>
            <p class="mx-auto mt-4 max-w-2xl text-slate-300">
                Our team has been notified. Please refresh this page, or continue from the home page while we resolve the issue.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="btn-primary">Return Home</a>
                <a href="{{ url()->current() }}" class="btn-secondary">Try Again</a>
            </div>
        </div>
    </section>
@endsection
