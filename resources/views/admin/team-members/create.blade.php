@extends('layouts.admin', ['heading' => 'Create Team Member'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Creating a team profile',
        'text' => 'These profiles humanize your studio, so keep names, roles, and experience labels clear and credible.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Team Member Details</h2>
            <p class="admin-muted mt-1">Use a consistent portrait style for a cohesive About page appearance.</p>
        </div>
        <form action="{{ route('admin.team-members.store') }}" method="POST" class="grid gap-4">
            @include('admin.team-members._form')
        </form>
    </div>
@endsection
