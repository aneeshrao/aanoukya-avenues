@extends('layouts.admin', ['heading' => 'Create Service'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @include('admin.services._form')
        </form>
    </div>
@endsection
