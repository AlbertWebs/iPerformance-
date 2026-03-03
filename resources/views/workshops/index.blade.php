@extends('layout')
@section('title', $meta_title ?? 'HR Workshops | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">HR Workshops</h1>
    <p class="mt-2 text-slate-600">Upcoming workshops for HR professionals.</p>
    <div class="mt-4">
        <a href="{{ route('workshops.archive') }}" class="text-sm font-medium text-primary hover:text-primary-hover">View past workshops →</a>
    </div>
    <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($workshops as $workshop)
            <article class="flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                @if($workshop->banner_image)
                    <img src="{{ asset('storage/'.$workshop->banner_image) }}" alt="{{ $workshop->title }}" class="h-52 w-full object-cover">
                @else
                    <div class="h-52 w-full bg-slate-200"></div>
                @endif
                <div class="flex flex-1 flex-col p-5">
                    <time class="text-sm text-slate-500">{{ $workshop->date->format('F j, Y') }}</time>
                    <h2 class="mt-2 text-lg font-semibold text-slate-900">{{ $workshop->title }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ Str::limit(strip_tags($workshop->description), 150) }}</p>
                    <p class="mt-2 text-xs text-slate-500">{{ $workshop->location }}</p>
                    @if($workshop->registration_link)
                        <a href="{{ $workshop->registration_link }}" target="_blank" rel="noopener" class="mt-4 inline-flex rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary-hover">Register</a>
                    @endif
                </div>
            </article>
        @empty
            <p class="col-span-full text-slate-500">No upcoming workshops at the moment. Check back later or <a href="{{ route('contact') }}" class="text-primary hover:underline">contact us</a>.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $workshops->links() }}</div>
</div>
@endsection
