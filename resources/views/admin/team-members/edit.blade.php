@extends('layouts.admin', ['heading' => 'Edit Team Member'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Editing a team profile',
        'text' => 'Keep the biography concise and aligned with how you want the studio to be perceived.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">Team Member Details</h2>
            <p class="admin-muted mt-1">Changes update this member card on the About page immediately after save.</p>
        </div>
        <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" class="grid gap-4">
            @method('PUT')
            @include('admin.team-members._form')
        </form>
    </div>
@endsection
