@extends('layouts.admin', ['heading' => 'Create Project'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Creating a project',
        'text' => 'Projects should include complete visual and narrative details to showcase your process and outcomes.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Project Details</h2>
            <p class="admin-muted mt-1">Cover image, category, and summary shape how this project is discovered.</p>
        </div>
        <form action="{{ route('admin.projects.store') }}" method="POST" class="grid gap-4">
            @include('admin.projects._form')
        </form>
    </div>
@endsection
