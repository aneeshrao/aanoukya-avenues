@extends('layouts.admin', ['heading' => 'Contact Inbox'])

@section('content')
    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.12em] text-slate-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Contact</th>
                    <th class="px-5 py-3">Project Type</th>
                    <th class="px-5 py-3">Message</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($submissions as $submission)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="font-medium">{{ $submission->name }}</p>
                            <p class="text-xs text-slate-500">{{ $submission->created_at->format('d M Y, h:i A') }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p>{{ $submission->email }}</p>
                            <p class="text-xs text-slate-500">{{ $submission->phone ?: '-' }}</p>
                        </td>
                        <td class="px-5 py-4">{{ $submission->project_type ?: '-' }}</td>
                        <td class="px-5 py-4 max-w-sm text-xs text-slate-600">{{ \Illuminate\Support\Str::limit($submission->message, 140) }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $submission->replied_at ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $submission->replied_at ? 'Replied' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            @if(!$submission->replied_at)
                                <form action="{{ route('admin.contacts.mark-replied', $submission) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-sm font-semibold text-[var(--color-accent-deep)] hover:text-[var(--color-ink)]">Mark replied</button>
                                </form>
                            @else
                                <span class="text-xs text-slate-500">{{ $submission->replied_at->format('d M Y') }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-500">No contact submissions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $submissions->links() }}
    </div>
@endsection
