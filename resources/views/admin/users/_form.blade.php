@csrf

@php
    $isEdit = $isEdit ?? false;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="name" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Full Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="email" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Email Address</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
</div>

<div class="mt-4 grid gap-4 md:grid-cols-2">
    <div>
        <label for="password" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">
            {{ $isEdit ? 'New Password (Optional)' : 'Password' }}
        </label>
        <input id="password" name="password" type="password" {{ $isEdit ? '' : 'required' }} class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
        @if($isEdit)
            <p class="admin-muted mt-2">Leave blank to keep the current password unchanged.</p>
        @endif
    </div>

    <div>
        <label for="password_confirmation" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" {{ $isEdit ? '' : 'required' }} class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
</div>

<div class="mt-4">
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="is_admin" value="0">
        <input type="checkbox" name="is_admin" value="1" class="rounded border-slate-300" @checked(old('is_admin', $user->is_admin ?? false))>
        Grant admin access
    </label>
    <p class="admin-muted mt-2">Admin users can access and edit all sections in this panel.</p>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="admin-btn-primary">Save User</button>
    <a href="{{ route('admin.users.index') }}" class="admin-btn-secondary">Cancel</a>
</div>
