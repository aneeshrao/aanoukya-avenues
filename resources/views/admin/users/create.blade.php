@extends('layouts.admin', ['heading' => 'Create User'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Creating a user account',
        'text' => 'Create individual accounts instead of sharing one password. This improves accountability and security.',
    ])
@endsection

@section('content')
    <div class="admin-surface p-6 md:p-7">
        <div class="mb-5 border-b border-slate-200 pb-4">
            <h2 class="text-lg font-semibold text-slate-800">User Details</h2>
            <p class="admin-muted mt-1">Set admin access only for trusted team members.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="grid gap-4">
            @include('admin.users._form', ['isEdit' => false])
        </form>
    </div>
@endsection
