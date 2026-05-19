@extends('layouts.admin', ['heading' => 'Users'])

@section('page_help')
    @include('admin.partials.help-panel', [
        'title' => 'User access help',
        'text' => 'Create one login per person. Mark only trusted team members as admin to keep the panel secure.',
        'tips' => [
            'Admin users can manage all website content.',
            'Non-admin users can sign in but cannot access admin pages.',
            'Keep at least two admin users to avoid lockout risk.',
        ],
    ])
@endsection

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.users.create') }}" class="admin-btn-primary">Add User</a>
    </div>

    <div class="admin-surface overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.12em] text-slate-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Role</th>
                    <th class="px-5 py-3">Updated</th>
                    <th class="px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr>
                        <td class="px-5 py-4 font-medium text-slate-800">{{ $user->name }}</td>
                        <td class="px-5 py-4 text-slate-600">{{ $user->email }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $user->is_admin ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-700' }}">
                                {{ $user->is_admin ? 'Admin' : 'Standard' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-500">{{ $user->updated_at?->format('d M Y, h:i A') }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900">Edit</a>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user account?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-semibold text-rose-600 hover:text-rose-700">Delete</button>
                                    </form>
                                @else
                                    <span class="text-xs text-slate-500">Current account</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-slate-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $users->links() }}
    </div>
@endsection
