@extends('admin.layout')
@section('title', 'Edit: ' . $user->name)
@section('heading', 'Users')
@section('content')
<div class="max-w-3xl">
    <nav class="mb-8 flex flex-wrap items-center gap-2 text-sm">
        <a href="{{ route('admin.users.index') }}" class="text-slate-500 transition hover:text-primary">Users</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="truncate font-medium text-slate-700" title="{{ $user->name }}">{{ Str::limit($user->name, 28) }}</span>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Edit</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div class="min-w-0 flex-1">
            <h2 class="text-xl font-bold text-slate-900">Edit user</h2>
            <p class="mt-1 text-base font-medium text-slate-800" title="{{ $user->name }}">{{ $user->name }}</p>
            <p class="mt-0.5 text-sm text-slate-600">{{ $user->email }}</p>
            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-600">
                @if($user->is_admin)
                    <span class="inline-flex rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium text-primary">Admin</span>
                @else
                    <span class="text-slate-500">User</span>
                @endif
                <span>{{ $user->bookings_count }} booking(s)</span>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" id="user-edit-form">
        @csrf
        @method('PUT')

        {{-- Profile --}}
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Profile</h3>
            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="e.g. +254..." class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('phone')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="position" class="block text-sm font-medium text-slate-700">Position</label>
                    <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}" placeholder="Job title" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('position')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- Organization --}}
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Organization</h3>
            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="organization_name" class="block text-sm font-medium text-slate-700">Organization name</label>
                    <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $user->organization_name) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('organization_name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="organization_email" class="block text-sm font-medium text-slate-700">Organization email</label>
                    <input type="email" name="organization_email" id="organization_email" value="{{ old('organization_email', $user->organization_email) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('organization_email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="organization_location" class="block text-sm font-medium text-slate-700">Organization location</label>
                    <input type="text" name="organization_location" id="organization_location" value="{{ old('organization_location', $user->organization_location) }}" placeholder="City or address" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('organization_location')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="organization_phone" class="block text-sm font-medium text-slate-700">Organization phone</label>
                    <input type="text" name="organization_phone" id="organization_phone" value="{{ old('organization_phone', $user->organization_phone) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('organization_phone')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        @if(auth()->id() !== $user->id)
            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Role</h3>
                <div class="mt-5 flex items-center gap-3">
                    <input type="hidden" name="is_admin" value="0">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                    <label for="is_admin" class="text-sm font-medium text-slate-700">Administrator (can access admin panel)</label>
                </div>
            </div>
        @endif

        <div class="h-24 flex-shrink-0"></div>
    </form>

    <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
        <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Save profile and organization details.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                <button type="submit" form="user-edit-form" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
