@extends('layout')

@section('title', $meta_title ?? 'HR Consulting & Certification')

@section('content')
{{-- Hero --}}
@php
    $tagline = $hero?->tagline ?? 'HR Consulting & Certification';
    $headline = $hero?->headline ?? 'HR excellence for';
    $headlineHighlight = $hero?->headline_highlight ?? 'Africa';
    $subtitle = $hero?->subtitle ?? 'Workshops, training programs, and certifications to build and validate your HR capabilities. Partner with us to elevate your people strategy.';
    $heroImage = null;
    $heroImageAlt = $hero?->image_alt ?? 'HR excellence and professional development';
    if ($hero && $hero->image) {
        $heroImage = asset('storage/'.$hero->image);
    }
    if (!$heroImage && file_exists(public_path('images/hero.jpg'))) {
        $heroImage = asset('images/hero.jpg');
    }
    if (!$heroImage) {
        $heroImage = 'https://images.unsplash.com/photo-1522071820081-009c0127c711?auto=format&fit=crop&w=800&q=80';
    }
@endphp
<section class="relative overflow-hidden home-hero-pattern text-white py-16 sm:py-20 lg:py-24 xl:py-32" style="background: linear-gradient(135deg, #080612 0%, #0d0a1c 30%, #120d28 55%, #161033 80%, #1a1340 100%);">
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16 lg:items-center">
            <div class="max-w-3xl">
                @if($tagline)<p class="text-sm font-medium uppercase tracking-widest text-white/70">{{ $tagline }}</p>@endif
                <h1 class="mt-4 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl lg:leading-tight">{{ $headline }}@if($headlineHighlight) <span class="text-primary-light">{{ $headlineHighlight }}</span>@endif</h1>
                @if($subtitle)<p class="mt-6 text-lg leading-relaxed text-slate-300 sm:text-xl">{{ $subtitle }}</p>@endif
                <div class="mt-10 flex flex-wrap items-center gap-4">
                    @if($hero && $hero->cta_1_text)
                        <a href="{{ $hero->resolveCtaUrl($hero->cta_1_url) }}" class="hero-cta-btn inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:bg-primary-hover">{{ $hero->cta_1_text }}</a>
                    @else
                        <a href="{{ route('workshops.index') }}" class="hero-cta-btn inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:bg-primary-hover">View workshops</a>
                    @endif
                    @if($hero && $hero->cta_2_text)
                        <a href="{{ $hero->resolveCtaUrl($hero->cta_2_url) }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/5 px-6 py-3.5 text-sm font-medium text-white backdrop-blur-sm transition hover:bg-white/10 hover:border-white/40">{{ $hero->cta_2_text }}</a>
                    @else
                        <a href="{{ route('trainings.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/5 px-6 py-3.5 text-sm font-medium text-white backdrop-blur-sm transition hover:bg-white/10 hover:border-white/40">Training calendar</a>
                    @endif
                    @if($hero && $hero->cta_3_text)
                        <a href="{{ $hero->resolveCtaUrl($hero->cta_3_url) }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/5 px-6 py-3.5 text-sm font-medium text-white backdrop-blur-sm transition hover:bg-white/10 hover:border-white/40">{{ $hero->cta_3_text }}</a>
                    @else
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/5 px-6 py-3.5 text-sm font-medium text-white backdrop-blur-sm transition hover:bg-white/10 hover:border-white/40">Contact us</a>
                    @endif
                </div>
            </div>
            <div class="relative lg:block">
                <div class="relative aspect-[4/3] overflow-hidden rounded-2xl shadow-2xl ring-1 ring-white/10 sm:aspect-[16/10] lg:aspect-auto lg:h-[380px] xl:h-[420px]">
                    <img src="{{ $heroImage }}" alt="{{ $heroImageAlt }}" class="h-full w-full object-cover object-center" fetchpriority="high">
                </div>
                <div class="absolute -inset-4 -z-10 rounded-3xl bg-gradient-to-br from-primary/30 to-transparent opacity-60 blur-2xl lg:-right-8 lg:-top-4"></div>
            </div>
        </div>
    </div>
</section>

{{-- Quick paths --}}
<section class="border-b border-slate-200 bg-white py-12 lg:py-14">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('workshops.index') }}" class="group flex items-start gap-4 rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-primary/30 hover:bg-primary/5 hover:shadow-sm">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary transition group-hover:bg-primary/15"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
                <div>
                    <h3 class="font-semibold text-slate-900 group-hover:text-primary transition">Workshops</h3>
                    <p class="mt-0.5 text-sm text-slate-600">Upcoming HR events</p>
                </div>
            </a>
            <a href="{{ route('trainings.index') }}" class="group flex items-start gap-4 rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-primary/30 hover:bg-primary/5 hover:shadow-sm">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary transition group-hover:bg-primary/15"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></span>
                <div>
                    <h3 class="font-semibold text-slate-900 group-hover:text-primary transition">Training</h3>
                    <p class="mt-0.5 text-sm text-slate-600">Programs & calendar</p>
                </div>
            </a>
            <a href="{{ route('certifications.index') }}" class="group flex items-start gap-4 rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-primary/30 hover:bg-primary/5 hover:shadow-sm">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary transition group-hover:bg-primary/15"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg></span>
                <div>
                    <h3 class="font-semibold text-slate-900 group-hover:text-primary transition">Certifications</h3>
                    <p class="mt-0.5 text-sm text-slate-600">Validate your skills</p>
                </div>
            </a>
            <a href="{{ route('verify') }}" class="group flex items-start gap-4 rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-primary/30 hover:bg-primary/5 hover:shadow-sm">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary transition group-hover:bg-primary/15"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg></span>
                <div>
                    <h3 class="font-semibold text-slate-900 group-hover:text-primary transition">Verify</h3>
                    <p class="mt-0.5 text-sm text-slate-600">Certificate check</p>
                </div>
            </a>
        </div>
    </div>
</section>

@if($workshops->isNotEmpty())
<section class="py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-widest text-primary">Upcoming</p>
                <h2 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">HR Workshops</h2>
            </div>
            <a href="{{ route('workshops.index') }}" class="text-sm font-semibold text-primary hover:text-primary-hover transition sm:shrink-0">View all →</a>
        </div>
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($workshops as $workshop)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    @if($workshop->banner_image)
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="{{ asset('storage/'.$workshop->banner_image) }}" alt="{{ $workshop->title }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                        </div>
                    @else
                        <div class="aspect-[16/10] bg-gradient-to-br from-primary/20 to-slate-200"></div>
                    @endif
                    <div class="flex flex-1 flex-col p-6">
                        <time class="text-sm font-medium text-slate-500">{{ $workshop->date->format('F j, Y') }}</time>
                        <h3 class="mt-2 text-lg font-semibold text-slate-900 group-hover:text-primary transition">{{ $workshop->title }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-slate-600">{{ Str::limit(strip_tags($workshop->description), 100) }}</p>
                        <p class="mt-3 flex items-center gap-1.5 text-xs text-slate-500">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $workshop->location }}
                        </p>
                        @php
                            $regHref = ($workshop->registration_link && \Illuminate\Support\Str::startsWith($workshop->registration_link, 'http')) ? $workshop->registration_link : route('register');
                            $regExt = \Illuminate\Support\Str::startsWith($regHref, 'http') && (parse_url($regHref, PHP_URL_HOST) !== request()->getHost());
                        @endphp
                        <a href="{{ $regHref }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover transition" @if($regExt) target="_blank" rel="noopener" @endif>Register <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($trainings->isNotEmpty())
<section class="bg-slate-50/80 py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-widest text-primary">Calendar</p>
                <h2 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">Upcoming Trainings</h2>
            </div>
            <a href="{{ route('trainings.index') }}" class="text-sm font-semibold text-primary hover:text-primary-hover transition sm:shrink-0">View calendar →</a>
        </div>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($trainings as $training)
                <article class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <span class="inline-block rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">{{ $training->category?->name ?? 'Training' }}</span>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900"><a href="{{ route('trainings.show', $training) }}" class="hover:text-primary transition">{{ $training->title }}</a></h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $training->start_date->format('M j') }} – {{ $training->end_date->format('M j, Y') }}</p>
                    @if($training->location)
                        <p class="mt-1 flex items-center gap-1.5 text-sm text-slate-500">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $training->location }}
                        </p>
                    @endif
                    <a href="{{ route('trainings.show', $training) }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover transition">View details <span aria-hidden="true">→</span></a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($certifications->isNotEmpty())
<section class="py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-medium uppercase tracking-widest text-primary">Credentials</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">Featured Certifications</h2>
        </div>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($certifications as $cert)
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    @if($cert->image)
                        <img src="{{ asset('storage/'.$cert->image) }}" alt="{{ $cert->title }}" class="h-20 w-full rounded-xl object-cover object-center">
                    @else
                        <div class="h-20 w-full rounded-xl bg-gradient-to-br from-primary/15 to-slate-100 flex items-center justify-center">
                            <svg class="h-10 w-10 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                    @endif
                    <h3 class="mt-5 font-semibold text-slate-900"><a href="{{ route('certifications.show', $cert) }}" class="hover:text-primary transition">{{ $cert->title }}</a></h3>
                    @if($cert->duration)
                        <p class="mt-1 text-sm text-slate-500">{{ $cert->duration }}</p>
                    @endif
                    <a href="{{ route('certifications.show', $cert) }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover transition">Learn more <span aria-hidden="true">→</span></a>
                </article>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            <a href="{{ route('certifications.index') }}" class="inline-flex rounded-xl bg-primary px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-hover hover:shadow-primary/25">View all certifications</a>
        </div>
    </div>
</section>
@endif

@if($reviews->isNotEmpty())
<section class="bg-slate-900 py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-medium uppercase tracking-widest text-primary-light/90">Testimonials</p>
            <h2 class="mt-1 text-2xl font-bold text-white sm:text-3xl">What our clients say</h2>
        </div>
        <div class="mt-12 overflow-hidden">
            <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth scrollbar-hide" id="testimonials-slider">
                @foreach($reviews as $review)
                    <div class="min-w-[320px] max-w-md flex-shrink-0 snap-start rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm">
                        <div class="flex gap-0.5 text-primary-light" aria-hidden="true">
                            @for($i = 0; $i < min($review->rating, 5); $i++) <span>★</span> @endfor
                        </div>
                        <blockquote class="mt-4 text-base leading-relaxed text-slate-200">"{{ Str::limit($review->content, 200) }}"</blockquote>
                        <div class="mt-6 flex items-center gap-4">
                            @if($review->image)
                                <img src="{{ asset('storage/'.$review->image) }}" alt="{{ $review->name }}" class="h-12 w-12 rounded-full object-cover ring-2 ring-white/20">
                            @else
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/80 text-sm font-semibold text-white">{{ substr($review->name, 0, 1) }}</div>
                            @endif
                            <div>
                                <p class="font-semibold text-white">{{ $review->name }}</p>
                                @if($review->company)
                                    <p class="text-sm text-slate-400">{{ $review->company }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('reviews.index') }}" class="text-sm font-semibold text-primary-light hover:text-white transition">View all reviews</a>
        </div>
    </div>
</section>
@endif

@if($services->isNotEmpty())
<section class="py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-medium uppercase tracking-widest text-primary">What we offer</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">Our services</h2>
        </div>
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    @if($service->icon)
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-2xl text-primary transition group-hover:bg-primary/15" aria-hidden="true">{{ $service->icon }}</span>
                    @elseif($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="h-24 w-full rounded-xl object-cover">
                    @else
                        <div class="h-24 w-full rounded-xl bg-gradient-to-br from-primary/10 to-slate-100 flex items-center justify-center">
                            <svg class="h-12 w-12 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <h3 class="mt-5 text-lg font-semibold text-slate-900"><a href="{{ route('services.show', $service) }}" class="hover:text-primary transition">{{ $service->title }}</a></h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service) }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover transition">Learn more <span aria-hidden="true">→</span></a>
                </article>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            <a href="{{ route('services.index') }}" class="text-sm font-semibold text-primary hover:text-primary-hover transition">View all services</a>
        </div>
    </div>
</section>
@endif

{{-- Verify CTA --}}
<section class="border-t border-slate-200 bg-slate-50 py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl rounded-2xl border border-slate-200 bg-white p-8 shadow-sm sm:p-10">
            <div class="flex flex-col items-center text-center sm:flex-row sm:items-start sm:text-left">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary" aria-hidden="true">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </span>
                <div class="mt-4 sm:ml-6 sm:mt-0">
                    <h2 class="text-xl font-bold text-slate-900">Verify a certificate</h2>
                    <p class="mt-2 text-slate-600">Enter a certificate number to confirm its authenticity.</p>
                    <form action="{{ route('verify.check') }}" method="POST" class="mt-6 flex flex-col gap-3 sm:flex-row">
                        @csrf
                        <input type="text" name="certificate_number" placeholder="Certificate number" required class="min-w-0 flex-1 rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <button type="submit" class="rounded-xl bg-primary px-6 py-3 font-semibold text-white transition hover:bg-primary-hover">Verify</button>
                    </form>
                    <a href="{{ route('verify') }}" class="mt-4 inline-block text-sm font-medium text-primary hover:text-primary-hover">Go to verification page</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
