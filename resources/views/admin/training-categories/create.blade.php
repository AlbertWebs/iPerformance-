@extends('admin.layout')
@section('title', 'Add Category')
@section('heading', 'Add Training Category')
@section('content')
<div class="max-w-2xl">
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.training-categories.index') }}" class="text-slate-500 transition hover:text-primary">Categories</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Add category</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">New training category</h2>
            <p class="mt-1 text-sm text-slate-600">Categories group trainings on the site (e.g. HR Management, Leadership). Name is required; slug is auto-generated if left blank.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.training-categories.store') }}" id="category-create-form" class="space-y-8">
        @csrf
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Details</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. HR Management" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <p class="mt-1 text-xs text-slate-500">Leave blank to auto-generate from name, or type your own (e.g. hr-management).</p>
                    <div class="mt-1.5 flex items-center gap-2">
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="hr-management" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <button type="button" id="slug-from-name" class="shrink-0 rounded-lg border border-slate-300 bg-slate-50 px-3 py-2.5 text-xs font-medium text-slate-600 transition hover:bg-slate-100" title="Generate from name">From name</button>
                    </div>
                    @error('slug')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="3" placeholder="Optional short description for this category." class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Options</h3>
            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="flex items-center gap-3 sm:items-end sm:pb-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                    <label for="is_active" class="text-sm font-medium text-slate-700">Active (visible on site)</label>
                </div>
            </div>
        </div>
        <div class="h-20 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-2xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Required: name.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.training-categories.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="category-create-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Create category
                </button>
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var nameEl = document.getElementById('name');
    var slugEl = document.getElementById('slug');
    var btn = document.getElementById('slug-from-name');
    if (!nameEl || !slugEl || !btn) return;
    function toSlug(s) {
        return (s || '').toString().toLowerCase().trim()
            .replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
    }
    btn.addEventListener('click', function() {
        var name = nameEl.value.trim();
        if (name) slugEl.value = toSlug(name);
    });
    nameEl.addEventListener('blur', function() {
        if (!slugEl.value.trim() && nameEl.value.trim()) slugEl.value = toSlug(nameEl.value);
    });
})();
</script>
@endsection
