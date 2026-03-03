@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'Verify Certificate | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 lg:px-8 text-center">
    <h1 class="text-3xl font-bold text-slate-900">Verify a Certificate</h1>
    <p class="mt-4 text-slate-600">Enter the certificate number below to confirm its authenticity and status.</p>
    <form method="POST" action="{{ route('verify.check') }}" class="mt-10">
        @csrf
        <div>
            <label for="certificate_number" class="sr-only">Certificate number</label>
            <input type="text" name="certificate_number" id="certificate_number" value="{{ old('certificate_number') }}" placeholder="Certificate number" required class="w-full rounded-lg border border-slate-300 px-4 py-4 text-center text-lg focus:border-primary focus:ring-1 focus:ring-primary">
            @error('certificate_number')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="mt-6 w-full rounded-lg bg-primary px-6 py-4 font-medium text-white hover:bg-primary-hover transition">Verify</button>
    </form>
</div>
@endsection
