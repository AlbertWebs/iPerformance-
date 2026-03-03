@extends('admin.layout')
@section('title', 'Generate Certificate')
@section('heading', 'Issued Certificates')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.certificates.index') }}" class="text-slate-500 transition hover:text-primary">Certificates</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Generate certificate</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div class="min-w-0 flex-1">
            <h2 class="text-xl font-bold text-slate-900">Generate certificate</h2>
            <p class="mt-1 text-sm text-slate-600">A new certificate number (IPC-YYYY-NNNNN) will be auto-generated. After saving, the print view opens so you can print it.</p>
            <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50/80 px-4 py-3">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Next certificate number</p>
                <p class="mt-1 font-mono text-lg font-semibold text-primary">{{ $nextNumber }}</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.certificates.store-generated') }}" id="certificate-generate-form">
        @csrf

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Recipient</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700">Link to user (optional)</label>
                    <select name="user_id" id="user_id" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <option value="">— None / Enter name manually —</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                    <p class="mt-1.5 text-xs text-slate-500">If selected, the name is pre-filled and the certificate appears in the user's portal.</p>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Recipient name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Full name as on certificate" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Course & date</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="course" class="block text-sm font-medium text-slate-700">Course / program *</label>
                    <input type="text" name="course" id="course" value="{{ old('course') }}" required placeholder="e.g. Certified HR Professional" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('course')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="date_issued" class="block text-sm font-medium text-slate-700">Date issued *</label>
                    <input type="date" name="date_issued" id="date_issued" value="{{ old('date_issued', date('Y-m-d')) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('date_issued')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Certificate number will be auto-generated. Print view opens after save.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="certificate-generate-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Generate & open for printing
                </button>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('user_id').addEventListener('change', function() {
    var sel = this;
    var opt = sel.options[sel.selectedIndex];
    if (opt.value && opt.text) {
        var name = opt.text.split(' (')[0];
        document.getElementById('name').value = name;
    }
});
</script>
@endsection
