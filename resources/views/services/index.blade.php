@extends('layout')
@section('title', $meta_title ?? 'Services | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Our Services</h1>
    <p class="mt-2 text-slate-600">HR consulting and solutions for your organization.</p>
    <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($services as $service)
            <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                @if($service->icon)
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-lg bg-primary/10 text-2xl text-primary">{{ $service->icon }}</span>
                @elseif($service->image)
                    <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="h-40 w-full rounded-lg object-cover">
                @endif
                <h2 class="mt-4 text-lg font-semibold text-slate-900"><a href="{{ route('services.show', $service) }}" class="hover:text-primary">{{ $service->title }}</a></h2>
                <p class="mt-2 text-sm text-slate-600">{{ $service->short_description }}</p>
                <a href="{{ route('services.show', $service) }}" class="mt-4 inline-flex text-sm font-medium text-primary hover:text-primary-hover">Learn more →</a>
            </article>
        @empty
            <p class="col-span-full text-slate-500">No services listed yet.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $services->links() }}</div>
</div>
@endsection
