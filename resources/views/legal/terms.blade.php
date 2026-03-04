@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'Terms and Conditions | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
    <nav class="mb-8">
        <a href="{{ route('register') }}" class="text-sm font-medium text-primary hover:text-primary-hover hover:underline">Back to registration</a>
    </nav>
    <div class="legal-prose rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        @if($content)
            <div class="legal-content text-slate-700">{!! $content !!}</div>
        @else
            <p class="text-slate-600">Terms and conditions are being updated. Please check back later.</p>
        @endif
    </div>
</div>
@endsection
