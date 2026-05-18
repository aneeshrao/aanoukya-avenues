@extends('layouts.admin', ['heading' => 'Dashboard'])

@section('content')
    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        <article class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Services</p>
            <p class="mt-3 text-3xl font-semibold">{{ $stats['services'] }}</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Projects</p>
            <p class="mt-3 text-3xl font-semibold">{{ $stats['projects'] }}</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Team Members</p>
            <p class="mt-3 text-3xl font-semibold">{{ $stats['team_members'] }}</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Testimonials</p>
            <p class="mt-3 text-3xl font-semibold">{{ $stats['testimonials'] }}</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Unreplied Leads</p>
            <p class="mt-3 text-3xl font-semibold text-[var(--color-accent-deep)]">{{ $stats['unreplied_contacts'] }}</p>
        </article>
    </section>

    <section class="mt-8 rounded-2xl border border-slate-200 bg-white">
        <div class="border-b border-slate-200 px-5 py-4">
            <h2 class="text-lg font-semibold text-slate-800">Latest Contact Submissions</h2>
        </div>
        <div class="overflow-x-auto">
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
@endsection
