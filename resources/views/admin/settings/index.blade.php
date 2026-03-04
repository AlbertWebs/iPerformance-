@extends('admin.layout')
@section('title', 'Settings')
@section('heading', 'Settings')
@section('content')
<div class="mb-8">
    <p class="text-sm text-slate-600">Configure site-wide and SEO settings.</p>
</div>
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <a href="{{ route('admin.hero.edit') }}" class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-primary/30 hover:shadow-md">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-primary/15">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h2 class="mt-4 text-lg font-semibold text-slate-900 group-hover:text-primary">Hero section</h2>
        <p class="mt-1 text-sm text-slate-600">Headline, subtitle, CTAs and image on the home page.</p>
    </a>
    <a href="{{ route('admin.legal.edit') }}" class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-primary/30 hover:shadow-md">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-primary/15">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <h2 class="mt-4 text-lg font-semibold text-slate-900 group-hover:text-primary">Terms &amp; Privacy</h2>
        <p class="mt-1 text-sm text-slate-600">Terms and Conditions and Privacy Policy (used on registration).</p>
    </a>
    <a href="{{ route('admin.page-meta.index') }}" class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-primary/30 hover:shadow-md">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-primary/15">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
        </div>
        <h2 class="mt-4 text-lg font-semibold text-slate-900 group-hover:text-primary">SEO & Page Meta</h2>
        <p class="mt-1 text-sm text-slate-600">Meta titles and descriptions for main pages.</p>
    </a>
</div>
@endsection
