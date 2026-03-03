@extends('admin.layout')
@section('title', 'Add Certification')
@section('heading', 'HR Certifications')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.certifications.index') }}" class="text-slate-500 transition hover:text-primary">Certifications</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Add certification</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 010-4.438 3.42 3.42 0 001.946-.806 3.42 3.42 0 013.138-3.138z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">New certification program</h2>
            <p class="mt-1 text-sm text-slate-600">Add an HR certification (e.g. CHRP). Slug can be left blank to auto-generate from the title.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.certifications.store') }}" enctype="multipart/form-data" id="certification-create-form">
        @csrf
        @include('admin.certifications.form')
        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Required: title.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.certifications.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="certification-create-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Create certification
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
