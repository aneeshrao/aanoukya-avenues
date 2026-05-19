@extends('layouts.admin', ['heading' => 'Edit User'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Editing user access',
        'text' => 'Update profile details and access level carefully to avoid accidental admin lockout.',
        'tips' => [
            'Do not remove admin access from all admin users.',
            'Password update is optional when editing existing users.',
        ],
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">User Details</h2>
            <p class="admin-muted mt-1">This updates login and role settings for {{ $user->name }}.</p>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="grid gap-4">
            @method('PUT')
            @include('admin.users._form', ['isEdit' => true])
        </form>
    </div>
@endsection
