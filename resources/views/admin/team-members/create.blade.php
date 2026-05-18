@extends('layouts.admin', ['heading' => 'Create Team Member'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.team-members.store') }}" method="POST">
            @include('admin.team-members._form')
        </form>
    </div>
@endsection
