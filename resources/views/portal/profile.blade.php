@extends('layout')
@section('title', 'Update profile | Portal | iPerformance Africa')
@section('content')
<div class="min-h-screen bg-slate-50/50">
    <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
        <a href="{{ route('portal.dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 transition hover:text-primary">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to dashboard
        </a>

        <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
                <div>
                    <h1 class="text-xl font-bold text-slate-900">Update profile</h1>
                    <p class="mt-0.5 text-sm text-slate-600">Keep your contact and organization details up to date.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('portal.profile.update') }}" class="mt-8 space-y-6">
                @csrf
                @method('PUT')

                @if(session('success'))
                    <div class="rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">Full name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20" autocomplete="name">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20" autocomplete="email">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20" autocomplete="tel" placeholder="e.g. 254712345678">
                    </div>
                    <div>
                        <label for="position" class="block text-sm font-medium text-slate-700">Position / Job title</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Optional">
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-6">
                    <h2 class="text-sm font-semibold text-slate-900">Organization (optional)</h2>
                    <p class="mt-0.5 text-xs text-slate-500">Your employer or organization details.</p>
                    <div class="mt-4 space-y-4">
                        <div>
                            <label for="organization_name" class="block text-sm font-medium text-slate-700">Organization name</label>
                            <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $user->organization_name) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label for="organization_email" class="block text-sm font-medium text-slate-700">Organization email</label>
                            <input type="email" name="organization_email" id="organization_email" value="{{ old('organization_email', $user->organization_email) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label for="organization_location" class="block text-sm font-medium text-slate-700">Organization location</label>
                            <input type="text" name="organization_location" id="organization_location" value="{{ old('organization_location', $user->organization_location) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label for="organization_phone" class="block text-sm font-medium text-slate-700">Organization phone</label>
                            <input type="tel" name="organization_phone" id="organization_phone" value="{{ old('organization_phone', $user->organization_phone) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:gap-3">
                    <a href="{{ route('portal.dashboard') }}" class="inline-flex justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex justify-center rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
