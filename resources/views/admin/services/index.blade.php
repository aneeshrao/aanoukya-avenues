@extends('layouts.admin', ['heading' => 'Services'])

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.services.create') }}" class="rounded-full bg-slate-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-white hover:bg-slate-800">Add Service</a>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.12em] text-slate-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Slug</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($services as $service)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ $service->name }}</td>
                        <td class="px-5 py-4 text-slate-600">{{ $service->slug }}</td>
                        <td class="px-5 py-4">{{ $service->display_order }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $service->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-700' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-slate-700 hover:text-slate-900">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-slate-500">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $services->links() }}
    </div>
@endsection
