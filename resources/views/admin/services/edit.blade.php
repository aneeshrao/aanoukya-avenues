@extends('layouts.admin', ['heading' => 'Edit Service'])

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @method('PUT')
            @include('admin.services._form')
        </form>
    </div>
@endsection
