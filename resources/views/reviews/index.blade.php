@extends('layout')
@section('title', $meta_title ?? 'Reviews & Testimonials | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Reviews & Testimonials</h1>
    <p class="mt-2 text-slate-600">What our clients say about us.</p>
    <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($reviews as $review)
            <blockquote class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex gap-1 text-primary">
                    @for($i = 0; $i < $review->rating; $i++) ★ @endfor
                </div>
                <p class="mt-4 text-slate-700">"{{ $review->content }}"</p>
                <footer class="mt-6 flex items-center gap-3">
                    @if($review->image)
                        <img src="{{ asset('storage/'.$review->image) }}" alt="{{ $review->name }}" class="h-12 w-12 rounded-full object-cover">
                    @else
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary font-semibold">{{ substr($review->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <cite class="font-medium text-slate-900 not-italic">{{ $review->name }}</cite>
                        @if($review->company)
                            <p class="text-sm text-slate-500">{{ $review->company }}</p>
                        @endif
                    </div>
                </footer>
            </blockquote>
        @empty
            <p class="col-span-full text-slate-500">No reviews yet.</p>
        @endforelse
    </div>
    <div class="mt-10">{{ $reviews->links() }}</div>
</div>
@endsection
