@extends('layouts.admin', ['heading' => 'Edit Project'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST">
            @method('PUT')
            @include('admin.projects._form')
        </form>
    </div>
@endsection
