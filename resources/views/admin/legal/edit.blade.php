@extends('admin.layout')
@section('title', 'Terms & Privacy')
@section('heading', 'Terms & Privacy')
@section('content')
<div class="max-w-4xl">
    @if(session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <p class="font-medium">Please fix the following:</p>
            <ul class="mt-1 list-inside list-disc space-y-0.5">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.settings.index') }}" class="text-slate-500 transition hover:text-primary">Settings</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Terms &amp; Privacy</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit Terms and Privacy</h2>
            <p class="mt-1 text-sm text-slate-600">Update the content shown on the Terms and Conditions and Privacy Policy pages (linked from registration).</p>
            <a href="{{ route('terms') }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover">View Terms</a>
            <span class="text-slate-400">·</span>
            <a href="{{ route('privacy') }}" target="_blank" rel="noopener" class="text-sm font-medium text-primary hover:text-primary-hover">View Privacy</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.legal.update') }}" id="legal-edit-form">
        @csrf
        @method('PUT')

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Terms and Conditions</h3>
            <p class="mt-1 text-xs text-slate-500">Use simple HTML: &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;. Shown at <a href="{{ route('terms') }}" target="_blank" rel="noopener" class="text-primary hover:underline">/terms</a>.</p>
            <textarea name="terms_content" id="terms_content" rows="18" class="mt-4 w-full rounded-xl border border-slate-300 px-4 py-3 font-mono text-sm focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="<h2>Terms and Conditions</h2>...">{{ old('terms_content', $legal->terms_content) }}</textarea>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Privacy Policy</h3>
            <p class="mt-1 text-xs text-slate-500">Use simple HTML: &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;. Shown at <a href="{{ route('privacy') }}" target="_blank" rel="noopener" class="text-primary hover:underline">/privacy</a>.</p>
            <textarea name="privacy_content" id="privacy_content" rows="18" class="mt-4 w-full rounded-xl border border-slate-300 px-4 py-3 font-mono text-sm focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="<h2>Privacy Policy</h2>...">{{ old('privacy_content', $legal->privacy_content) }}</textarea>
        </div>

        <div class="h-24 flex-shrink-0"></div>

        <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
            <div class="mx-auto flex max-w-4xl flex-wrap items-center justify-between gap-4">
                <a href="{{ route('admin.settings.index') }}" class="text-sm font-medium text-slate-600 hover:text-primary">Back to Settings</a>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Terms &amp; Privacy
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
