@extends('admin.layout')
@section('title', 'Edit: ' . $service->title)
@section('heading', 'Services')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex flex-wrap items-center gap-2 text-sm">
        <a href="{{ route('admin.services.index') }}" class="text-slate-500 transition hover:text-primary">Services</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="truncate font-medium text-slate-700" title="{{ $service->title }}">{{ Str::limit($service->title, 32) }}</span>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Edit</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <div class="min-w-0 flex-1">
            <h2 class="text-xl font-bold text-slate-900">Edit service</h2>
            <p class="mt-1 text-base font-medium text-slate-800" title="{{ $service->title }}">{{ Str::limit($service->title, 60) }}</p>
            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-600">
                Order {{ $service->sort_order ?? 0 }}
                @if($service->is_active)<span class="text-emerald-600">Active</span>@else<span class="text-slate-500">Inactive</span>@endif
            </div>
            <a href="{{ route('services.show', $service) }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View on site
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" id="service-edit-form">
        @csrf
        @method('PUT')
        @include('admin.services.form', ['service' => $service])
        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3">
                <p class="text-sm text-slate-500">Save your changes when done.</p>
                <a href="{{ route('services.show', $service) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View on site
                </a>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="service-edit-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Update service
                </button>
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var titleEl = document.getElementById('title');
    var slugEl = document.getElementById('slug');
    var btn = document.getElementById('slug-from-title');
    if (!titleEl || !slugEl) return;
    function toSlug(s) {
        return (s || '').toString().toLowerCase().trim()
            .replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
    }
    if (btn) {
        btn.addEventListener('click', function() {
            var title = titleEl.value.trim();
            if (title) slugEl.value = toSlug(title);
        });
        titleEl.addEventListener('blur', function() {
            if (!slugEl.value.trim() && titleEl.value.trim()) slugEl.value = toSlug(titleEl.value);
        });
    }
})();
</script>
@endsection
