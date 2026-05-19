@extends('layouts.admin', ['heading' => 'Edit Project'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Editing a project',
        'text' => 'Keep this entry accurate and up-to-date since it directly influences portfolio quality perception.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Project Details</h2>
            <p class="admin-muted mt-1">Update visuals and narrative whenever final photos or milestones change.</p>
        </div>
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="grid gap-4">
            @method('PUT')
            @include('admin.projects._form')
        </form>
    </div>
@endsection
