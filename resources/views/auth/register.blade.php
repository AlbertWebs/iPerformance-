@extends('layout')
@section('title', 'Register | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-2xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Create your account</h1>
    <p class="mt-2 text-slate-600">Register to access the student portal, view upcoming trainings, and manage your profile.</p>
    @if($errors->any())
        <div class="mt-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}" class="mt-10 space-y-6">
        @csrf
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-slate-700">Full name (required)</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email (required)</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
            <div class="sm:col-span-2">
                <label for="position" class="block text-sm font-medium text-slate-700">Position / Title</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
        </div>

        <div class="border-t border-slate-200 pt-6">
            <h2 class="text-lg font-semibold text-slate-800">Organization (optional)</h2>
            <p class="mt-1 text-sm text-slate-600">For invoicing and certificates.</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="organization_name" class="block text-sm font-medium text-slate-700">Organization name</label>
                    <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div>
                    <label for="organization_email" class="block text-sm font-medium text-slate-700">Organization email</label>
                    <input type="email" name="organization_email" id="organization_email" value="{{ old('organization_email') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div>
                    <label for="organization_location" class="block text-sm font-medium text-slate-700">Organization location</label>
                    <input type="text" name="organization_location" id="organization_location" value="{{ old('organization_location') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div class="sm:col-span-2">
                    <label for="organization_phone" class="block text-sm font-medium text-slate-700">Organization phone</label>
                    <input type="text" name="organization_phone" id="organization_phone" value="{{ old('organization_phone') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password (required)</label>
                <input type="password" name="password" id="password" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
        </div>

        <div>
            <label class="flex items-start gap-3">
                <input type="checkbox" name="accept_terms" id="accept_terms" value="1" {{ old('accept_terms') ? 'checked' : '' }} required class="mt-1 rounded border-slate-300 text-primary focus:ring-primary">
                <span class="text-sm text-slate-700">I accept the Terms &amp; Conditions and Privacy Policy of iPerformance Africa.</span>
            </label>
        </div>

        <button type="submit" class="w-full rounded-lg bg-primary px-6 py-3 font-medium text-white hover:bg-primary-hover transition sm:w-auto">Register</button>
    </form>
    <p class="mt-6 text-sm text-slate-600">Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">Log in here</a>.</p>
</div>
@endsection
