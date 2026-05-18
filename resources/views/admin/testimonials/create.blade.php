@extends('layouts.admin', ['heading' => 'Create Testimonial'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.testimonials.store') }}" method="POST">
            @include('admin.testimonials._form')
        </form>
    </div>
@endsection
