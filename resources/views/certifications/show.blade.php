@extends('layout')
@section('title', isset($meta_title) ? $meta_title : $certification->title)
@section('content')
<div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <a href="{{ route('certifications.index') }}" class="text-sm font-medium text-primary hover:text-primary-hover">Back to Certifications</a>
    <article class="mt-8">
        @if($certification->image)
            <img src="{{ asset('storage/'.$certification->image) }}" alt="" class="w-full rounded-xl object-cover h-64">
        @endif
        <h1 class="mt-8 text-3xl font-bold text-slate-900">{{ $certification->title }}</h1>
        @if($certification->duration)
            <p class="mt-2 text-slate-600">Duration: {{ $certification->duration }}</p>
        @endif
        @if($certification->description)
            <div class="mt-8"><div class="text-slate-600">{!! nl2br(e($certification->description)) !!}</div></div>
        @endif
        @if($certification->accreditation_details)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-slate-900">Accreditation</h2>
                <div class="mt-2 text-slate-600">{!! nl2br(e($certification->accreditation_details)) !!}</div>
            </div>
        @endif
        @if($certification->requirements)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-slate-900">Requirements</h2>
                <div class="mt-2 text-slate-600">{!! nl2br(e($certification->requirements)) !!}</div>
            </div>
        @endif
        @php
            $certRegHref = ($certification->apply_link && \Illuminate\Support\Str::startsWith($certification->apply_link, 'http')) ? $certification->apply_link : route('register');
            $certRegExt = \Illuminate\Support\Str::startsWith($certRegHref, 'http') && (parse_url($certRegHref, PHP_URL_HOST) !== request()->getHost());
        @endphp
        <div class="mt-10 flex flex-wrap items-center gap-3">
            <a href="{{ $certRegHref }}" class="inline-flex rounded-xl border border-slate-300 px-6 py-3 font-medium text-slate-800 transition hover:bg-slate-50" @if($certRegExt) target="_blank" rel="noopener" @endif>Register for this certification</a>
            <a href="{{ route('contact') }}" class="inline-flex text-sm text-primary hover:text-primary-hover">Questions? Contact us</a>
        </div>
    </article>
</div>
@endsection
