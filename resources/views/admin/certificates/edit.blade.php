@extends('admin.layout')
@section('title', 'Edit: ' . $certificate->certificate_number)
@section('heading', 'Issued Certificates')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex flex-wrap items-center gap-2 text-sm">
        <a href="{{ route('admin.certificates.index') }}" class="text-slate-500 transition hover:text-primary">Certificates</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-mono font-medium text-slate-700" title="{{ $certificate->certificate_number }}">{{ Str::limit($certificate->certificate_number, 20) }}</span>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Edit</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <div class="min-w-0 flex-1">
            <h2 class="text-xl font-bold text-slate-900">Edit certificate</h2>
            <p class="mt-1 font-mono text-base font-medium text-slate-800">{{ $certificate->certificate_number }}</p>
            <p class="mt-0.5 text-sm text-slate-600">{{ $certificate->name }} · {{ $certificate->course }}</p>
            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm">
                @if($certificate->status === 'valid')
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-800">Valid</span>
                @elseif($certificate->status === 'expired')
                    <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800">Expired</span>
                @else
                    <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Revoked</span>
                @endif
            </div>
            <a href="{{ route('admin.certificates.print', $certificate) }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print certificate
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.certificates.update', $certificate) }}" id="certificate-edit-form">
        @csrf
        @method('PUT')

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Certificate</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="certificate_number" class="block text-sm font-medium text-slate-700">Certificate number *</label>
                    <input type="text" name="certificate_number" id="certificate_number" value="{{ old('certificate_number', $certificate->certificate_number) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('certificate_number')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700">Link to user (optional)</label>
                    <select name="user_id" id="user_id" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <option value="">— None —</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ old('user_id', $certificate->user_id) == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
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
                    <input type="text" name="name" id="name" value="{{ old('name', $certificate->name) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="course" class="block text-sm font-medium text-slate-700">Course / program *</label>
                    <input type="text" name="course" id="course" value="{{ old('course', $certificate->course) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('course')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Date & status</h3>
            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="date_issued" class="block text-sm font-medium text-slate-700">Date issued *</label>
                    <input type="date" name="date_issued" id="date_issued" value="{{ old('date_issued', $certificate->date_issued?->format('Y-m-d')) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('date_issued')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status *</label>
                    <select name="status" id="status" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <option value="valid" {{ old('status', $certificate->status) === 'valid' ? 'selected' : '' }}>Valid</option>
                        <option value="expired" {{ old('status', $certificate->status) === 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="revoked" {{ old('status', $certificate->status) === 'revoked' ? 'selected' : '' }}>Revoked</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3">
                <p class="text-sm text-slate-500">Save your changes.</p>
                <a href="{{ route('admin.certificates.print', $certificate) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover">Print</a>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="certificate-edit-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Update certificate
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
