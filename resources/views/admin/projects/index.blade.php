@extends('layouts.admin', ['heading' => 'Projects'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'Projects section help',
        'text' => 'Projects are your strongest sales asset. Prioritize clear titles, categories, and complete image sets.',
        'tips' => [
            'Mark only high-impact work as Featured for homepage visibility.',
            'Use consistent category names to keep filters clean.',
            'Cover image quality heavily impacts first impressions.',
        ],
    ])
@endsection

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.projects.create') }}" class="admin-btn-primary">Add Project</a>
    </div>

    <div class="admin-surface overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.12em] text-slate-500">
                <tr>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Category</th>
                    <th class="px-5 py-3">Order</th>
                    <th class="px-5 py-3">Flags</th>
                    <th class="px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($projects as $project)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ $project->title }}</td>
                        <td class="px-5 py-4">{{ $project->category }}</td>
                        <td class="px-5 py-4">{{ $project->display_order }}</td>
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-2">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $project->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-700' }}">{{ $project->is_active ? 'Active' : 'Inactive' }}</span>
                                @if($project->is_featured)
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Featured</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Edit</a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-rose-600 hover:text-rose-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-slate-500">No projects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $projects->links() }}
    </div>
@endsection
