@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'Past Workshops | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Past Workshops</h1>
    <p class="mt-2 text-slate-600">Archive of past HR workshops.</p>
    <div class="mt-4">
        <a href="{{ route('workshops.index') }}" class="text-sm font-medium text-primary hover:text-primary-hover">Back to upcoming workshops</a>
    </div>
    <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($workshops as $workshop)
            <article class="flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm opacity-90">
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
                </div>
            </article>
        @empty
            <p class="col-span-full text-slate-500">No past workshops in the archive yet.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $workshops->links() }}</div>
</div>
@endsection
