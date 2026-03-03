@extends('admin.layout')
@section('title', 'Add Training')
@section('heading', 'Add Training')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.trainings.index') }}" class="text-slate-500 transition hover:text-primary">Trainings</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Add training</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">New training program</h2>
            <p class="mt-1 text-sm text-slate-600">Add a training to the calendar. Set a price to enable M-Pesa payment from the portal. Start and end dates default to today and +2 days; change as needed.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.trainings.store') }}" enctype="multipart/form-data" id="training-create-form">
        @csrf
        @include('admin.trainings.form')
        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Required: title, start date, end date.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.trainings.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="training-create-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Create training
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
