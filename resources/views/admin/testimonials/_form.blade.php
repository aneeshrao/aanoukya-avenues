@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="client_name" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Client Name</label>
        <input id="client_name" name="client_name" type="text" value="{{ old('client_name', $testimonial->client_name ?? '') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="client_title" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Client Title</label>
        <input id="client_title" name="client_title" type="text" value="{{ old('client_title', $testimonial->client_title ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="company" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Company</label>
        <input id="company" name="company" type="text" value="{{ old('company', $testimonial->company ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
    <div>
        <label for="rating" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Rating (1-5)</label>
        <input id="rating" name="rating" type="number" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>

    <div>
        <label for="display_order" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Display Order</label>
        <input id="display_order" name="display_order" type="number" min="0" value="{{ old('display_order', $testimonial->display_order ?? 0) }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
    </div>
</div>

<div class="mt-4">
    <label for="quote" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Quote</label>
    <textarea id="quote" name="quote" rows="6" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300" @checked(old('is_active', $testimonial->is_active ?? true))>
        Active
    </label>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded-full bg-slate-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-white hover:bg-slate-800">Save</button>
    <a href="{{ route('admin.testimonials.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-slate-700 hover:bg-slate-100">Cancel</a>
</div>
