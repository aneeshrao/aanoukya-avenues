@extends('layouts.admin', ['heading' => 'Create Service'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Creating a service',
        'text' => 'Write value-focused copy that clearly explains what the service delivers for clients.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Service Details</h2>
            <p class="admin-muted mt-1">This content appears on service cards and the service detail page.</p>
        </div>
        <form action="{{ route('admin.services.store') }}" method="POST" class="grid gap-4">
            @include('admin.services._form')
        </form>
    </div>
@endsection
