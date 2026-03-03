@extends('admin.layout')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('content')
<div class="mb-8">
    <p class="text-slate-600">Overview of your site content and activity.</p>
</div>
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <a href="{{ route('admin.workshops.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $totalWorkshops }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Workshops</div>
    </a>
    <a href="{{ route('admin.trainings.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $totalTrainings }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Trainings</div>
    </a>
    <a href="{{ route('admin.certifications.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $totalCertifications }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Certifications</div>
    </a>
    <a href="{{ route('admin.reviews.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $totalReviews }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Reviews</div>
    </a>
</div>
<div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $totalUsers }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Registered users</div>
    </a>
    <a href="{{ route('admin.bookings.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $totalBookings }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Total bookings</div>
        <div class="mt-1 text-xs text-emerald-600">{{ $paidBookings }} paid</div>
    </a>
    <a href="{{ route('admin.contacts.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold {{ $pendingContacts > 0 ? 'text-amber-600' : 'text-primary' }}">{{ $pendingContacts }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Pending contacts</div>
    </a>
    <a href="{{ route('admin.verification-logs.index') }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md hover:border-primary/20">
        <div class="text-3xl font-bold text-primary">{{ $verificationSearches }}</div>
        <div class="mt-1 text-sm font-medium text-slate-600">Verification searches</div>
    </a>
</div>
@endsection
