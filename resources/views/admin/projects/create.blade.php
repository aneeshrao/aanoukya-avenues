@extends('layouts.admin', ['heading' => 'Create Project'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.projects.store') }}" method="POST">
            @include('admin.projects._form')
        </form>
    </div>
@endsection
