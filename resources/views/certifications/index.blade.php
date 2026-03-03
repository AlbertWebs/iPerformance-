@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'HR Certifications | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">HR Certifications</h1>
    <p class="mt-2 text-slate-600">Recognized credentials for HR professionals.</p>
    @if($featured->isNotEmpty())
        <h2 class="mt-12 text-xl font-semibold text-slate-900">Featured Certifications</h2>
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($featured as $cert)
                <article class="rounded-xl border-2 border-primary/20 bg-primary/5 p-6">
                    @if($cert->image)
                        <img src="{{ asset('storage/'.$cert->image) }}" alt="{{ $cert->title }}" class="h-24 w-full rounded-lg object-cover">
                    @endif
                    <h3 class="mt-4 font-semibold text-slate-900"><a href="{{ route('certifications.show', $cert) }}" class="hover:text-primary">{{ $cert->title }}</a></h3>
                    @if($cert->duration)
                        <p class="mt-1 text-sm text-slate-500">{{ $cert->duration }}</p>
                    @endif
                    <a href="{{ route('certifications.show', $cert) }}" class="mt-4 inline-flex text-sm font-medium text-primary hover:text-primary-hover">Learn more and apply</a>
                </article>
            @endforeach
        </div>
    @endif
    <h2 class="mt-12 text-xl font-semibold text-slate-900">All Certifications</h2>
    <div class="mt-6 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($certifications as $cert)
            <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                @if($cert->image)
                    <img src="{{ asset('storage/'.$cert->image) }}" alt="{{ $cert->title }}" class="h-32 w-full rounded-lg object-cover">
                @endif
                <h3 class="mt-4 font-semibold text-slate-900"><a href="{{ route('certifications.show', $cert) }}" class="hover:text-primary">{{ $cert->title }}</a></h3>
                @if($cert->duration)
                    <p class="mt-1 text-sm text-slate-500">{{ $cert->duration }}</p>
                @endif
                <p class="mt-2 text-sm text-slate-600">{{ Str::limit(strip_tags($cert->description), 120) }}</p>
                <a href="{{ route('certifications.show', $cert) }}" class="mt-4 inline-flex text-sm font-medium text-primary hover:text-primary-hover">View details and apply</a>
            </article>
        @empty
            <p class="col-span-full text-slate-500">No certifications listed yet.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $certifications->links() }}</div>
</div>
@endsection
