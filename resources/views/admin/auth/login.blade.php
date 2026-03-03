<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-lg">
            <h1 class="text-2xl font-bold text-slate-800 text-center mb-2">iPerformance Africa</h1>
            <p class="text-slate-500 text-center text-sm mb-6">Admin Login</p>
            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
                    {{ $errors->first() }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-slate-300 text-primary focus:ring-primary">
                    <label for="remember" class="ml-2 text-sm text-slate-600">Remember me</label>
                </div>
                <button type="submit" class="w-full rounded-lg bg-primary px-4 py-2.5 font-medium text-white hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">Sign in</button>
            </form>
            <p class="mt-4 text-center text-sm text-slate-500">Not an admin? <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">User login</a></p>
        </div>
    </div>
</body>
</html>
