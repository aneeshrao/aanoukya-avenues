@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="title" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Project Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $project->title ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="slug" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Slug</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $project->slug ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="category" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Category</label>
        <input id="category" name="category" type="text" value="{{ old('category', $project->category ?? '') }}" required placeholder="Residential" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="location" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Location</label>
        <input id="location" name="location" type="text" value="{{ old('location', $project->location ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="year_label" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Year</label>
        <input id="year_label" name="year_label" type="text" value="{{ old('year_label', $project->year_label ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="project_area" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Project Area</label>
        <input id="project_area" name="project_area" type="text" value="{{ old('project_area', $project->project_area ?? '') }}" placeholder="4,800 sq.ft" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="status_label" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Status</label>
        <input id="status_label" name="status_label" type="text" value="{{ old('status_label', $project->status_label ?? '') }}" placeholder="Completed" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="display_order" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Display Order</label>
        <input id="display_order" name="display_order" type="number" min="0" value="{{ old('display_order', $project->display_order ?? 0) }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
</div>

<div class="mt-4">
    <label for="cover_image" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Cover Image URL</label>
    <input id="cover_image" name="cover_image" type="url" value="{{ old('cover_image', $project->cover_image ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
</div>

<div class="mt-4">
    <label for="gallery_images" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Gallery Image URLs (one per line)</label>
    <textarea id="gallery_images" name="gallery_images" rows="4" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('gallery_images', isset($project) && $project->gallery_images ? implode(PHP_EOL, (array) $project->gallery_images) : '') }}</textarea>
</div>

<div class="mt-4">
    <label for="summary" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Summary</label>
    <textarea id="summary" name="summary" rows="3" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('summary', $project->summary ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label for="description" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Detailed Description</label>
    <textarea id="description" name="description" rows="8" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('description', $project->description ?? '') }}</textarea>
</div>

<div class="mt-4 flex flex-wrap gap-5">
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300" @checked(old('is_featured', $project->is_featured ?? false))>
        Featured
    </label>
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300" @checked(old('is_active', $project->is_active ?? true))>
        Active
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded-full bg-slate-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-white hover:bg-slate-800">Save</button>
    <a href="{{ route('admin.projects.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-slate-700 hover:bg-slate-100">Cancel</a>
</div>
