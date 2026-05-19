@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="name" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $teamMember->name ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="role" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Role</label>
        <input id="role" name="role" type="text" value="{{ old('role', $teamMember->role ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="photo" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Photo URL or Path</label>
        <input id="photo" name="photo" type="text" value="{{ old('photo', $teamMember->photo ?? '') }}" placeholder="https://... or /images/member.avif" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
        <p class="admin-muted mt-2">Use approved team images with similar crop and lighting.</p>
    </div>
    <div>
        <label for="experience_label" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Experience Label</label>
        <input id="experience_label" name="experience_label" type="text" value="{{ old('experience_label', $teamMember->experience_label ?? '') }}" placeholder="12+ years" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="display_order" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Display Order</label>
        <input id="display_order" name="display_order" type="number" min="0" value="{{ old('display_order', $teamMember->display_order ?? 0) }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
</div>

<div class="mt-4">
    <label for="bio" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Bio (Optional)</label>
    <textarea id="bio" name="bio" rows="6" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('bio', $teamMember->bio ?? '') }}</textarea>
    <p class="admin-muted mt-2">Best practice: 2 to 4 concise lines focused on expertise and approach.</p>
</div>

<div class="mt-4">
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300" @checked(old('is_active', $teamMember->is_active ?? true))>
        Active
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="admin-btn-primary">Save</button>
    <a href="{{ route('admin.team-members.index') }}" class="admin-btn-secondary">Cancel</a>
</div>
