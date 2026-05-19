@extends('layouts.admin', ['heading' => 'Create Testimonial'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Creating a testimonial',
        'text' => 'Capture concise, specific feedback that communicates trust and project quality.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Testimonial Details</h2>
            <p class="admin-muted mt-1">Keep quotes clean and easy to scan for homepage testimonial cards.</p>
        </div>
        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="grid gap-4">
            @include('admin.testimonials._form')
        </form>
    </div>
@endsection
