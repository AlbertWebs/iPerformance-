@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'Training Calendar | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Training Calendar</h1>
    <p class="mt-2 text-slate-600">Upcoming trainings and programs.</p>
    @if($categories->isNotEmpty())
        <div class="mt-6 flex flex-wrap gap-2">
            <a href="{{ route('trainings.index') }}" class="rounded-full px-4 py-2 text-sm font-medium {{ !isset($category) ? 'bg-primary text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">All</a>
            @foreach($categories as $c)
                <a href="{{ route('trainings.category', $c) }}" class="rounded-full px-4 py-2 text-sm font-medium {{ (isset($category) && $category->id === $c->id) ? 'bg-primary text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">{{ $c->name }}</a>
            @endforeach
        </div>
    @endif
    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($trainings as $training)
            <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                @if($training->image)
                    <img src="{{ asset('storage/'.$training->image) }}" alt="{{ $training->title }}" class="h-40 w-full rounded-lg object-cover">
                @endif
                <span class="mt-4 inline-block text-xs font-medium text-primary">{{ $training->category ? $training->category->name : 'Training' }}</span>
                <h2 class="mt-2 text-lg font-semibold text-slate-900"><a href="{{ route('trainings.show', $training) }}" class="hover:text-primary">{{ $training->title }}</a></h2>
                <p class="mt-2 text-sm text-slate-600">{{ $training->start_date->format('M j') }} – {{ $training->end_date->format('M j, Y') }}</p>
                @if($training->location)
                    <p class="mt-1 text-sm text-slate-500">{{ $training->location }}</p>
                @endif
                <p class="mt-2 text-sm text-slate-600">{{ Str::limit(strip_tags($training->description), 120) }}</p>
                <a href="{{ route('trainings.show', $training) }}" class="mt-4 inline-flex rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary-hover">View details and register</a>
            </article>
        @empty
            <p class="col-span-full text-slate-500">No upcoming trainings at the moment.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $trainings->links() }}</div>
</div>
@endsection
