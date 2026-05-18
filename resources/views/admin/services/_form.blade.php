@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="name" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Service Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $service->name ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="slug" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Slug</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $service->slug ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="icon" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Icon Label</label>
        <input id="icon" name="icon" type="text" value="{{ old('icon', $service->icon ?? '') }}" placeholder="Architecture" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="display_order" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Display Order</label>
        <input id="display_order" name="display_order" type="number" min="0" value="{{ old('display_order', $service->display_order ?? 0) }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
</div>

<div class="mt-4">
    <label for="short_description" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Short Description</label>
    <textarea id="short_description" name="short_description" rows="3" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('short_description', $service->short_description ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label for="description" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Detailed Description</label>
    <textarea id="description" name="description" rows="7" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300" @checked(old('is_active', $service->is_active ?? true))>
        Active
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded-full bg-slate-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-white hover:bg-slate-800">Save</button>
    <a href="{{ route('admin.services.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-slate-700 hover:bg-slate-100">Cancel</a>
</div>
