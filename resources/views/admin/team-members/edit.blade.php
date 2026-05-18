@extends('layouts.admin', ['heading' => 'Edit Team Member'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST">
            @method('PUT')
            @include('admin.team-members._form')
        </form>
    </div>
@endsection
