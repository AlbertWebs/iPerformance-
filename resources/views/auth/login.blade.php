@extends('layout')
@section('title', 'Sign in | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-md px-4 py-12 sm:px-6 lg:px-8">
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm sm:shadow-md px-6 py-8 sm:px-8 sm:py-10">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Sign in</h1>
        <p class="mt-2 text-slate-600">Sign in to access the student portal.</p>

        @if($errors->any())
            <div class="mt-6 rounded-xl bg-red-50 border border-red-200/80 px-4 py-3 text-sm text-red-800" role="alert">
                <p class="font-medium">{{ $errors->first() }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5" novalidate>
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email" placeholder="you@example.com"
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900 placeholder-slate-400 transition focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 {{ $errors->has('email') ? 'border-red-400' : '' }}">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" id="password" required
                    autocomplete="current-password" placeholder="••••••••"
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900 placeholder-slate-400 transition focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 {{ $errors->has('password') ? 'border-red-400' : '' }}">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="remember" id="remember"
                    class="h-4 w-4 rounded border-slate-300 text-primary transition focus:ring-2 focus:ring-primary/20 focus:ring-offset-0">
                <label for="remember" class="text-sm text-slate-700 cursor-pointer select-none">Remember me</label>
            </div>
            <button type="submit" class="w-full rounded-lg bg-primary px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 active:scale-[0.99]">
                Sign in
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-200">
            <p class="text-sm text-slate-600">Don't have an account? <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-hover hover:underline focus:outline-none focus:underline">Register here</a>.</p>
        </div>
    </div>
</div>
@endsection
