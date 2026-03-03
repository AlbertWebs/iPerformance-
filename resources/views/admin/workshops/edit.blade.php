@extends('admin.layout')

@section('title', 'Edit Workshop')
@section('heading', 'Edit Workshop')

@section('content')
<div class="max-w-3xl">
    {{-- Breadcrumb --}}
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.workshops.index') }}" class="text-slate-500 transition hover:text-primary">Workshops</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="truncate font-medium text-slate-700" title="{{ $workshop->title }}">{{ Str::limit($workshop->title, 32) }}</span>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Edit</span>
    </nav>

    {{-- Page header --}}
    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <div class="min-w-0 flex-1">
            <h2 class="text-xl font-bold text-slate-900">Edit workshop</h2>
            <p class="mt-1 text-sm text-slate-600">{{ $workshop->date->format('M j, Y') }} · {{ $workshop->location }}@if($workshop->is_active) · <span class="text-emerald-600">Active</span>@else · <span class="text-slate-500">Inactive</span>@endif</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.workshops.update', $workshop) }}" enctype="multipart/form-data" id="workshop-edit-form">
        @csrf
        @method('PUT')
        @include('admin.workshops.form', ['workshop' => $workshop])
        <div class="h-24 flex-shrink-0"></div>
    </form>

    {{-- Sticky action bar --}}
    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Save your changes when done.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.workshops.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="workshop-edit-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Update workshop
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
