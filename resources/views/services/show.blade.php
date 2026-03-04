@extends('layout')
@section('title', $meta_title ?? $service->title)
@section('content')
<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-slate-500">
        <a href="{{ route('services.index') }}" class="font-medium text-primary hover:text-primary-hover hover:underline">Services</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-700">{{ $service->title }}</span>
    </nav>

    <article class="mt-8">
        {{-- Featured image --}}
        @if($service->image)
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100 shadow-sm ring-1 ring-slate-900/5">
                <img
                    src="{{ asset('storage/'.$service->image) }}"
                    alt="{{ $service->title }}"
                    class="h-56 w-full object-cover sm:h-72 md:h-80"
                    loading="eager"
                >
            </div>
        @else
            <div class="flex h-48 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 sm:h-56 md:h-64" aria-hidden="true">
                <span class="text-4xl text-slate-300 sm:text-5xl">{{ $service->icon ?: '—' }}</span>
            </div>
        @endif

        {{-- Title and intro --}}
        <header class="mt-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">{{ $service->title }}</h1>
            @if($service->short_description)
                <p class="mt-4 text-lg leading-relaxed text-slate-600">{{ $service->short_description }}</p>
            @endif
        </header>

        {{-- Full description --}}
        @if($service->full_description)
            <div class="service-prose mt-10 border-t border-slate-200 pt-10">
                <div class="service-content text-slate-700 leading-relaxed">{!! nl2br(e($service->full_description)) !!}</div>
            </div>
        @endif

        {{-- CTA --}}
        <div class="mt-12 flex flex-wrap items-center gap-4 border-t border-slate-200 pt-10">
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Get in touch
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('services.index') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-primary">← All services</a>
        </div>
    </article>
</div>
@endsection
