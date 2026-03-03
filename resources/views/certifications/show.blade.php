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
        @if($certification->apply_link)
            <div class="mt-10"><a href="{{ $certification->apply_link }}" target="_blank" rel="noopener" class="inline-flex rounded-lg bg-primary px-6 py-3 font-medium text-white hover:bg-primary-hover">Apply now</a></div>
        @else
            <div class="mt-10"><a href="{{ route('contact') }}" class="inline-flex rounded-lg bg-primary px-6 py-3 font-medium text-white hover:bg-primary-hover">Contact us to apply</a></div>
        @endif
    </article>
</div>
@endsection
