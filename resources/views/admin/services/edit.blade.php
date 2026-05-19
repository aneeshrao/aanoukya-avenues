@extends('layouts.admin', ['heading' => 'Edit Service'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Editing a service',
        'text' => 'Update copy carefully to preserve tone consistency across service listings and detail pages.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Service Details</h2>
            <p class="admin-muted mt-1">Changes here update this service anywhere it appears on the public site.</p>
        </div>
        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="grid gap-4">
            @method('PUT')
            @include('admin.services._form')
        </form>
    </div>
@endsection
