@extends('layouts.admin', ['heading' => 'Edit Testimonial'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
            @method('PUT')
            @include('admin.testimonials._form')
        </form>
    </div>
@endsection
