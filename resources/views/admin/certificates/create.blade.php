@extends('admin.layout')
@section('title', 'Add Certificate')
@section('heading', 'Issued Certificates')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.certificates.index') }}" class="text-slate-500 transition hover:text-primary">Certificates</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Add certificate</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Add certificate manually</h2>
            <p class="mt-1 text-sm text-slate-600">Enter certificate number and details. Suggested next number: <span class="font-mono font-medium text-primary">{{ $nextNumber ?? '—' }}</span></p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.certificates.store') }}" id="certificate-create-form">
        @csrf

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Certificate</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="certificate_number" class="block text-sm font-medium text-slate-700">Certificate number *</label>
                    <p class="mt-1 text-xs text-slate-500">Format: IPC-YYYY-NNNNN. Next suggested: {{ $nextNumber ?? '—' }}</p>
                    <input type="text" name="certificate_number" id="certificate_number" value="{{ old('certificate_number', $nextNumber ?? '') }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('certificate_number')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700">Link to user (optional)</label>
                    <select name="user_id" id="user_id" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <option value="">— None —</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Recipient & course</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Full name as on certificate" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="course" class="block text-sm font-medium text-slate-700">Course / program *</label>
                    <input type="text" name="course" id="course" value="{{ old('course') }}" required placeholder="e.g. Certified HR Professional" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('course')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Date & status</h3>
            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="date_issued" class="block text-sm font-medium text-slate-700">Date issued *</label>
                    <input type="date" name="date_issued" id="date_issued" value="{{ old('date_issued') }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('date_issued')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status *</label>
                    <select name="status" id="status" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <option value="valid" {{ old('status', 'valid') === 'valid' ? 'selected' : '' }}>Valid</option>
                        <option value="expired" {{ old('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="revoked" {{ old('status') === 'revoked' ? 'selected' : '' }}>Revoked</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Required: certificate number, name, course, date, status.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="certificate-create-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Add certificate
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
