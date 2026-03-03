@extends('layout')
@section('title', 'Portal | iPerformance Africa')
@section('content')
<div class="min-h-screen bg-slate-50/50">
<div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-10 lg:px-8">
    {{-- Welcome card: mobile-first, profile link --}}
    <div class="mb-8 sm:mb-10 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:gap-6 sm:p-6">
        <div class="flex min-w-0 flex-1 items-center gap-3 sm:gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-lg font-bold text-white shadow-lg shadow-primary/20 ring-2 ring-primary/10 sm:h-16 sm:w-16 sm:rounded-2xl sm:text-2xl">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="min-w-0 flex-1">
                <h1 class="truncate text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">Welcome back, {{ $user->name }}</h1>
                <p class="mt-0.5 text-sm text-slate-600 sm:text-base">Your learning and training hub. Book courses and pay with M-Pesa from here.</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:gap-3">
            <a href="{{ route('portal.profile.edit') }}" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:border-primary/30 hover:bg-primary/5 hover:text-primary sm:min-h-0 sm:py-2.5">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Update profile
            </a>
            <a href="{{ route('workshops.index') }}" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:border-primary/30 hover:bg-primary/5 hover:text-primary sm:min-h-0 sm:py-2.5">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Browse workshops
            </a>
            <a href="{{ route('trainings.index') }}" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:border-primary/30 hover:bg-primary/5 hover:text-primary sm:min-h-0 sm:py-2.5">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Browse trainings
            </a>
        </div>
    </div>

    {{-- My Bookings --}}
    @if($myBookings->isNotEmpty())
        <section class="mb-8 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:mb-10 sm:p-6">
            <div class="flex flex-wrap items-center justify-between gap-3 sm:gap-4">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </span>
                    <div class="min-w-0">
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">My bookings</h2>
                        <p class="mt-0.5 text-xs text-slate-600 sm:text-sm">Your course registrations and payment status.</p>
                    </div>
                </div>
                <span class="rounded-full bg-primary/10 px-3 py-1.5 text-xs font-semibold text-primary sm:px-4 sm:text-sm">{{ $myBookings->count() }} booking(s)</span>
            </div>
            <ul class="mt-5 space-y-3 sm:mt-6">
                @foreach($myBookings as $b)
                    <li class="flex flex-col gap-3 rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-4 transition hover:border-primary/20 hover:bg-primary/5 hover:shadow-sm sm:flex-row sm:items-center sm:justify-between sm:gap-4 sm:px-5">
                        <div class="flex min-w-0 items-center gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $b->status === 'paid' ? 'bg-emerald-100 text-emerald-600' : ($b->status === 'failed' ? 'bg-red-100 text-red-600' : 'bg-primary/10 text-primary') }}">
                                @if($b->status === 'paid')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </span>
                            <div class="min-w-0 flex-1">
                                <span class="font-medium text-slate-900">{{ $b->bookable?->title ?? 'Course' }}</span>
                                <span class="ml-2 inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold
                                    @if($b->status === 'paid') bg-emerald-100 text-emerald-800
                                    @elseif($b->status === 'failed') bg-red-100 text-red-800
                                    @else bg-primary/10 text-primary
                                    @endif">{{ ucfirst($b->status) }}</span>
                                @if($b->mpesa_reference)
                                    <p class="mt-1 text-xs text-slate-500">Ref: {{ $b->mpesa_reference }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-left sm:text-right">
                            <span class="text-sm font-semibold text-slate-900">KES {{ number_format($b->amount, 0) }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    {{-- My Certifications --}}
    <section class="mb-8 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:mb-10 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-4">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </span>
                <div class="min-w-0">
                    <h2 class="text-base font-semibold text-slate-900 sm:text-lg">My certifications</h2>
                    <p class="mt-0.5 text-xs text-slate-600 sm:text-sm">Certificates issued to you. Verify anytime from the public page.</p>
                </div>
            </div>
            <a href="{{ route('verify') }}" class="inline-flex min-h-[44px] items-center justify-center gap-1.5 rounded-xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-700 transition hover:border-primary/30 hover:bg-primary/5 hover:text-primary sm:min-h-0 sm:py-2">Verify a certificate <span aria-hidden="true">→</span></a>
        </div>
        @if($myCertificates->isNotEmpty())
            <ul class="mt-5 space-y-3 sm:mt-6">
                @foreach($myCertificates as $cert)
                    <li class="flex flex-col gap-3 rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-4 transition hover:border-primary/20 hover:bg-primary/5 hover:shadow-sm sm:flex-row sm:items-center sm:justify-between sm:gap-4 sm:px-5">
                        <div class="flex min-w-0 items-center gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $cert->status === 'valid' ? 'bg-emerald-100 text-emerald-600' : ($cert->status === 'expired' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-600') }}">
                                @if($cert->status === 'valid')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </span>
                            <div class="min-w-0 flex-1">
                                <span class="font-medium text-slate-900">{{ $cert->course }}</span>
                                <span class="ml-2 inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold
                                    @if($cert->status === 'valid') bg-emerald-100 text-emerald-800
                                    @elseif($cert->status === 'expired') bg-amber-100 text-amber-800
                                    @else bg-slate-100 text-slate-700
                                    @endif">{{ ucfirst($cert->status) }}</span>
                                <p class="mt-1 text-xs text-slate-500">No. {{ $cert->certificate_number }} · Issued {{ $cert->date_issued->format('M j, Y') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('verify') }}?number={{ urlencode($cert->certificate_number) }}" class="min-h-[44px] inline-flex items-center justify-center rounded-xl border border-slate-300 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:min-h-0 sm:py-2">Verify</a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="mt-5 rounded-xl border border-dashed border-slate-200 bg-slate-50/30 px-4 py-6 text-center sm:mt-6 sm:px-6 sm:py-8">
                <p class="text-sm text-slate-600 sm:text-base">You don’t have any certificates yet. Complete a training or certification program to receive one.</p>
                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:justify-center sm:gap-3">
                    <a href="{{ route('certifications.index') }}" class="inline-flex min-h-[44px] items-center justify-center rounded-xl bg-primary px-4 py-3 text-sm font-medium text-white transition hover:bg-primary-hover sm:min-h-0 sm:py-2">Browse certifications</a>
                    <a href="{{ route('trainings.index') }}" class="inline-flex min-h-[44px] items-center justify-center rounded-xl border border-slate-300 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:min-h-0 sm:py-2">Browse trainings</a>
                </div>
            </div>
        @endif
    </section>

    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
        @if($upcomingWorkshops->isNotEmpty())
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </span>
                    <div class="min-w-0">
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">Upcoming workshops</h2>
                        <p class="mt-0.5 text-xs text-slate-600 sm:text-sm">Pay with M-Pesa from this page.</p>
                    </div>
                </div>
                <ul class="mt-4 space-y-3 sm:mt-5 sm:space-y-4">
                    @foreach($upcomingWorkshops as $workshop)
                        <li class="flex flex-col gap-3 rounded-xl border border-slate-100 bg-slate-50/30 px-4 py-3 transition hover:border-slate-200 hover:bg-slate-50/50 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('workshops.index') }}" class="font-medium text-slate-900 hover:text-primary">{{ $workshop->title }}</a>
                                <p class="mt-0.5 flex items-center gap-1.5 text-sm text-slate-500">
                                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $workshop->date?->format('M j, Y') }}
                                    <span class="text-slate-400">·</span>
                                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    {{ $workshop->location }}
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2 sm:shrink-0">
                                @if(isset($workshop->price) && $workshop->price > 0)
                                    <button type="button" class="book-btn min-h-[44px] flex-1 rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover sm:min-h-0 sm:flex-none sm:py-2" data-type="workshop" data-id="{{ $workshop->id }}" data-title="{{ $workshop->title }}" data-amount="{{ $workshop->price }}">Pay with M-Pesa</button>
                                @endif
                                @if($workshop->registration_link)
                                    <a href="{{ $workshop->registration_link }}" target="_blank" rel="noopener" class="min-h-[44px] inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:min-h-0 sm:flex-none sm:py-2">Register</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('workshops.index') }}" class="mt-4 inline-flex min-h-[44px] items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover sm:mt-5 sm:min-h-0">View all workshops <span aria-hidden="true">→</span></a>
            </div>
        @endif

        @if($upcomingTrainings->isNotEmpty())
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                    <div class="min-w-0">
                        <h2 class="text-base font-semibold text-slate-900 sm:text-lg">Available trainings</h2>
                        <p class="mt-0.5 text-xs text-slate-600 sm:text-sm">Book and pay with M-Pesa in two steps.</p>
                    </div>
                </div>
                <ul class="mt-4 space-y-3 sm:mt-5 sm:space-y-4">
                    @foreach($upcomingTrainings as $training)
                        <li class="flex flex-col gap-3 rounded-xl border border-slate-100 bg-slate-50/30 px-4 py-3 transition hover:border-slate-200 hover:bg-slate-50/50 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('trainings.show', $training) }}" class="font-medium text-slate-900 hover:text-primary">{{ $training->title }}</a>
                                @if($training->location)
                                    <p class="mt-0.5 flex items-center gap-1.5 text-sm text-slate-500">
                                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        {{ $training->location }}
                                    </p>
                                @endif
                                @if(isset($training->price) && $training->price > 0)
                                    <p class="mt-1 text-sm font-semibold text-primary">KES {{ number_format($training->price, 0) }}</p>
                                @endif
                            </div>
                            <div class="flex flex-wrap gap-2 sm:shrink-0">
                                @if(isset($training->price) && $training->price > 0)
                                    <button type="button" class="book-btn min-h-[44px] flex-1 rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover sm:min-h-0 sm:flex-none sm:py-2" data-type="training" data-id="{{ $training->id }}" data-title="{{ $training->title }}" data-amount="{{ $training->price }}">Pay with M-Pesa</button>
                                @endif
                                @if($training->registration_link)
                                    <a href="{{ $training->registration_link }}" target="_blank" rel="noopener" class="min-h-[44px] inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:min-h-0 sm:flex-none sm:py-2">Register</a>
                                @endif
                                <a href="{{ route('trainings.show', $training) }}" class="min-h-[44px] inline-flex flex-1 items-center justify-center rounded-xl border border-slate-300 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 sm:min-h-0 sm:flex-none sm:py-2">View</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('trainings.index') }}" class="mt-4 inline-flex min-h-[44px] items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover sm:mt-5 sm:min-h-0">View all trainings <span aria-hidden="true">→</span></a>
            </div>
        @endif
    </div>

    @if($upcomingWorkshops->isEmpty() && $upcomingTrainings->isEmpty())
        <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm sm:p-12">
            <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 sm:h-16 sm:w-16">
                <svg class="h-7 w-7 sm:h-8 sm:w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </span>
            <h3 class="mt-4 text-base font-semibold text-slate-900 sm:text-lg">No upcoming events yet</h3>
            <p class="mt-2 text-sm text-slate-600 sm:text-base">Check back later for workshops and trainings, or get in touch for more information.</p>
            <div class="mt-6 flex flex-col gap-3 sm:mt-8 sm:flex-row sm:flex-wrap sm:justify-center sm:gap-4">
                <a href="{{ route('workshops.index') }}" class="inline-flex min-h-[44px] items-center justify-center rounded-xl bg-primary px-5 py-3 text-sm font-medium text-white transition hover:bg-primary-hover sm:min-h-0 sm:py-2.5">Browse workshops</a>
                <a href="{{ route('trainings.index') }}" class="inline-flex min-h-[44px] items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50 sm:min-h-0 sm:py-2.5">Browse trainings</a>
                <a href="{{ route('contact') }}" class="inline-flex min-h-[44px] items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50 sm:min-h-0 sm:py-2.5">Contact us</a>
            </div>
        </div>
    @endif
</div>
</div>

{{-- Book course modal: two-step flow --}}
<div id="book-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true" aria-labelledby="book-modal-title">
    <div class="flex min-h-full items-center justify-center p-4">
        <div id="book-modal-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative w-full max-w-md rounded-2xl border border-slate-200 bg-white shadow-2xl">
            <div class="p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <h2 id="book-modal-title" class="text-xl font-bold text-slate-900">Pay for course</h2>
                    <button type="button" id="book-modal-close" class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600" aria-label="Close">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Step 1: Register --}}
                <div id="book-step1">
                    <div class="mt-3 flex gap-2">
                        <span class="h-1 flex-1 rounded-full bg-primary"></span>
                        <span class="h-1 flex-1 rounded-full bg-slate-200"></span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600">Confirm your details and M-Pesa number for payment.</p>
                    <div class="mt-5 space-y-5">
                        <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-500">Course</span>
                            <p id="book-course-title" class="mt-1 font-medium text-slate-900"></p>
                            <p id="book-course-amount" class="mt-0.5 text-lg font-bold text-primary"></p>
                        </div>
                        <div>
                            <label for="book-mpesa-phone" class="block text-sm font-medium text-slate-700">M-Pesa phone number</label>
                            <input type="tel" id="book-mpesa-phone" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="07XX XXX XXX" value="{{ old('phone', $user->phone) }}">
                            <p class="mt-1.5 text-xs text-slate-500">Number that will receive the M-Pesa prompt (254 or 0...)</p>
                            <p id="book-step1-error" class="mt-1.5 hidden text-sm text-red-600"></p>
                        </div>
                    </div>
                    <div class="mt-8 flex gap-3">
                        <button type="button" id="book-cancel" class="flex-1 rounded-xl border border-slate-300 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</button>
                        <button type="button" id="book-step1-submit" class="flex-1 rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">Continue to payment</button>
                    </div>
                </div>

                {{-- Step 2: M-Pesa --}}
                <div id="book-step2" class="hidden">
                    <div class="mt-3 flex gap-2">
                        <span class="h-1 flex-1 rounded-full bg-primary"></span>
                        <span class="h-1 flex-1 rounded-full bg-primary"></span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600">You will receive an M-Pesa prompt on your phone. Enter your PIN to complete payment.</p>
                    <div class="mt-5 rounded-xl border border-primary/20 bg-primary/5 p-4">
                        <p id="book-step2-summary" class="text-sm font-medium text-slate-900"></p>
                        <p class="mt-1 text-sm text-slate-600">Click below to send the prompt to your phone.</p>
                    </div>
                    <p id="book-step2-error" class="mt-3 hidden rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700"></p>
                    <p id="book-step2-wait" class="mt-3 hidden flex items-center gap-2 rounded-lg bg-primary/10 px-3 py-2.5 text-sm font-medium text-primary">
                        <svg class="h-5 w-5 shrink-0 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                        Waiting for payment… Complete the prompt on your phone.
                    </p>
                    <div class="mt-8 flex gap-3">
                        <button type="button" id="book-back" class="flex-1 rounded-xl border border-slate-300 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Back</button>
                        <button type="button" id="book-pay-btn" class="flex-1 rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">Pay with M-Pesa</button>
                    </div>
                </div>

                {{-- Success --}}
                <div id="book-success" class="hidden text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 ring-4 ring-emerald-50">
                        <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-900">Booking successful</h3>
                    <p id="book-success-message" class="mt-2 text-sm text-slate-600"></p>
                    <p id="book-success-ref" class="mt-1 text-xs font-medium text-slate-500"></p>
                    <button type="button" id="book-close-success" class="mt-8 w-full rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('book-modal');
    var backdrop = document.getElementById('book-modal-backdrop');
    var step1 = document.getElementById('book-step1');
    var step2 = document.getElementById('book-step2');
    var successEl = document.getElementById('book-success');
    var courseTitleEl = document.getElementById('book-course-title');
    var courseAmountEl = document.getElementById('book-course-amount');
    var phoneInput = document.getElementById('book-mpesa-phone');
    var step1Error = document.getElementById('book-step1-error');
    var step2Error = document.getElementById('book-step2-error');
    var step2Wait = document.getElementById('book-step2-wait');
    var step2Summary = document.getElementById('book-step2-summary');
    var payBtn = document.getElementById('book-pay-btn');
    var successMessage = document.getElementById('book-success-message');
    var successRef = document.getElementById('book-success-ref');
    var csrf = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var storeUrl = '{{ route("portal.bookings.store") }}';
    var bookingId = null;
    var bookType = null;
    var bookId = null;
    var bookTitle = null;
    var bookAmount = null;
    var pollTimer = null;

    function openModal(type, id, title, amount) {
        bookType = type;
        bookId = id;
        bookTitle = title;
        bookAmount = amount;
        bookingId = null;
        courseTitleEl.textContent = title;
        courseAmountEl.textContent = 'KES ' + Number(amount).toLocaleString();
        step1.classList.remove('hidden');
        step2.classList.add('hidden');
        successEl.classList.add('hidden');
        step1Error.classList.add('hidden');
        step2Error.classList.add('hidden');
        step2Wait.classList.add('hidden');
        step2Summary.textContent = '';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = null;
    }

    document.querySelectorAll('.book-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            openModal(
                this.getAttribute('data-type'),
                parseInt(this.getAttribute('data-id'), 10),
                this.getAttribute('data-title'),
                parseFloat(this.getAttribute('data-amount'))
            );
        });
    });

    backdrop.addEventListener('click', closeModal);
    document.getElementById('book-cancel').addEventListener('click', closeModal);
    document.getElementById('book-modal-close').addEventListener('click', closeModal);
    document.getElementById('book-close-success').addEventListener('click', function() {
        closeModal();
        window.location.reload();
    });

    document.getElementById('book-back').addEventListener('click', function() {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');
        step2Error.classList.add('hidden');
        step2Wait.classList.add('hidden');
        payBtn.disabled = false;
        payBtn.textContent = 'Pay with M-Pesa';
    });

    document.getElementById('book-step1-submit').addEventListener('click', function() {
        var phone = (phoneInput.value || '').trim();
        step1Error.classList.add('hidden');
        if (!phone) {
            step1Error.textContent = 'Please enter your M-Pesa phone number.';
            step1Error.classList.remove('hidden');
            return;
        }
        var btn = this;
        btn.disabled = true;
        btn.textContent = 'Please wait…';
        fetch(storeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ type: bookType, id: bookId, mpesa_phone: phone })
        }).then(function(r) { return r.json().then(function(d) { return { ok: r.ok, data: d }; }); })
        .then(function(res) {
            btn.disabled = false;
            btn.textContent = 'Continue to payment';
            if (res.ok && res.data.booking_id) {
                bookingId = res.data.booking_id;
                step2Summary.textContent = (res.data.course_title || bookTitle) + ' — KES ' + Number(res.data.amount).toLocaleString();
                step1.classList.add('hidden');
                step2.classList.remove('hidden');
            } else {
                step1Error.textContent = res.data.message || 'Something went wrong. Please try again.';
                step1Error.classList.remove('hidden');
            }
        })
        .catch(function() {
            btn.disabled = false;
            btn.textContent = 'Continue to payment';
            step1Error.textContent = 'Network error. Please try again.';
            step1Error.classList.remove('hidden');
        });
    });

    payBtn.addEventListener('click', function() {
        if (!bookingId) return;
        step2Error.classList.add('hidden');
        payBtn.disabled = true;
        payBtn.textContent = 'Sending…';
        fetch('/portal/bookings/' + bookingId + '/pay', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        }).then(function(r) { return r.json().then(function(d) { return { ok: r.ok, status: r.status, data: d }; }); })
        .then(function(res) {
            if (res.ok && res.data.checkout_request_id) {
                step2Wait.classList.remove('hidden');
                pollStatus();
            } else if (res.status === 200 && res.data.status === 'paid') {
                step2Wait.classList.add('hidden');
                showSuccess(res.data);
            } else {
                step2Error.textContent = res.data.message || 'Could not send payment request. Try again.';
                step2Error.classList.remove('hidden');
                payBtn.disabled = false;
                payBtn.textContent = 'Pay with M-Pesa';
            }
        })
        .catch(function() {
            step2Error.textContent = 'Network error. Please try again.';
            step2Error.classList.remove('hidden');
            payBtn.disabled = false;
            payBtn.textContent = 'Pay with M-Pesa';
        });
    });

    function pollStatus() {
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(function() {
            fetch('/portal/bookings/' + bookingId + '/status', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            }).then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.status === 'paid') {
                    if (pollTimer) clearInterval(pollTimer);
                    pollTimer = null;
                    step2Wait.classList.add('hidden');
                    showSuccess(data);
                } else if (data.status === 'failed') {
                    if (pollTimer) clearInterval(pollTimer);
                    pollTimer = null;
                    step2Wait.classList.add('hidden');
                    step2Error.textContent = 'Payment was not completed. You can try again.';
                    step2Error.classList.remove('hidden');
                    payBtn.disabled = false;
                    payBtn.textContent = 'Pay with M-Pesa';
                }
            });
        }, 2500);
    }

    function showSuccess(data) {
        step2.classList.add('hidden');
        successEl.classList.remove('hidden');
        successMessage.textContent = (data.course_title || bookTitle) + ' — Booking confirmed.';
        successRef.textContent = data.mpesa_reference ? 'M-Pesa ref: ' + data.mpesa_reference : '';
    }
});
</script>
@endsection
