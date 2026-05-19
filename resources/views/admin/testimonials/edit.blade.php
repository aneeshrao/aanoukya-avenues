@extends('layouts.admin', ['heading' => 'Edit Testimonial'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Editing a testimonial',
        'text' => 'Maintain authentic voice while refining grammar and clarity for better readability.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Testimonial Details</h2>
            <p class="admin-muted mt-1">Changes appear instantly wherever testimonials are rendered on the website.</p>
        </div>
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="grid gap-4">
            @method('PUT')
            @include('admin.testimonials._form')
        </form>
    </div>
@endsection
