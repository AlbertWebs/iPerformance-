@extends('layout')
@section('title', $meta_title ?? $service->title)
@section('content')
<div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <a href="{{ route('services.index') }}" class="text-sm font-medium text-primary hover:text-primary-hover">← Services</a>
    <article class="mt-8">
        @if($service->image)
            <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="w-full rounded-xl object-cover h-64">
        @endif
        <h1 class="mt-8 text-3xl font-bold text-slate-900">{{ $service->title }}</h1>
        @if($service->short_description)
            <p class="mt-4 text-lg text-slate-600">{{ $service->short_description }}</p>
        @endif
        @if($service->full_description)
            <div class="mt-8 prose prose-slate max-w-none text-slate-600">
                {!! nl2br(e($service->full_description)) !!}
            </div>
        @endif
        <div class="mt-10">
            <a href="{{ route('contact') }}" class="inline-flex rounded-lg bg-primary px-6 py-3 font-medium text-white hover:bg-primary-hover">Get in touch</a>
        </div>
    </article>
</div>
@endsection
