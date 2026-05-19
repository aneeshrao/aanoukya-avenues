@extends('layouts.admin', ['heading' => 'Dashboard'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'How to use this dashboard',
        'text' => 'Use this overview to monitor content health and quickly jump into the section you need to update.',
        'tips' => [
            'Unreplied leads should be checked daily in Contact Inbox.',
            'Keep display order clean so the public pages stay intentional.',
            'Use Site Content for global copy changes across all pages.',
        ],
    ])
@endsection

@section('content')
    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        <article class="admin-surface p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Services</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['services'] }}</p>
            <p class="admin-muted mt-2">Published service offerings.</p>
        </article>
        <article class="admin-surface p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Projects</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['projects'] }}</p>
            <p class="admin-muted mt-2">Portfolio items currently listed.</p>
        </article>
        <article class="admin-surface p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Team Members</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['team_members'] }}</p>
            <p class="admin-muted mt-2">People shown on About page.</p>
        </article>
        <article class="admin-surface p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Testimonials</p>
            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stats['testimonials'] }}</p>
            <p class="admin-muted mt-2">Client proof points in rotation.</p>
        </article>
        <article class="admin-surface border-orange-200 bg-orange-50/90 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Unreplied Leads</p>
            <p class="mt-3 text-3xl font-semibold text-[#9a4518]">{{ $stats['unreplied_contacts'] }}</p>
            <p class="admin-muted mt-2">Follow up soon to keep conversions high.</p>
        </article>
    </section>

    <section class="admin-surface mt-8 p-5 md:p-6">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 pb-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">Latest Contact Submissions</h2>
                <p class="admin-muted mt-1">Newest messages received from the website contact form.</p>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="admin-btn-secondary">Open Inbox</a>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.12em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Project Type</th>
                        <th class="px-5 py-3">Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($latestSubmissions as $submission)
                        <tr>
                            <td class="px-5 py-4">{{ $submission->name }}</td>
                            <td class="px-5 py-4">{{ $submission->email }}</td>
                            <td class="px-5 py-4">{{ $submission->project_type ?: '-' }}</td>
                            <td class="px-5 py-4">{{ $submission->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-slate-500">No submissions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="admin-surface mt-6 p-5 md:p-6">
        <h2 class="text-lg font-semibold text-slate-800">Quick Actions</h2>
        <p class="admin-muted mt-1">Jump straight to high-frequency content tasks.</p>
        <div class="mt-4 grid gap-3 md:grid-cols-2 xl:grid-cols-5">
            <a href="{{ route('admin.projects.create') }}" class="admin-btn-secondary">Add Project</a>
            <a href="{{ route('admin.services.create') }}" class="admin-btn-secondary">Add Service</a>
            <a href="{{ route('admin.team-members.create') }}" class="admin-btn-secondary">Add Team Member</a>
            <a href="{{ route('admin.testimonials.create') }}" class="admin-btn-secondary">Add Testimonial</a>
            <a href="{{ route('admin.users.index') }}" class="admin-btn-secondary">Manage Users</a>
        </div>
    </section>
@endsection
