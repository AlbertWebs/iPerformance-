@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'Contact Us | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Contact Us</h1>
    <p class="mt-2 text-slate-600">Get in touch with our team.</p>
    @if($errors->any())
        <div class="mt-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('contact.store') }}" class="mt-10 space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Name (required)</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email (required)</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">
        </div>
        <div>
            <label for="message" class="block text-sm font-medium text-slate-700">Message (required)</label>
            <textarea name="message" id="message" rows="5" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-primary focus:ring-1 focus:ring-primary">{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="rounded-lg bg-primary px-6 py-3 font-medium text-white hover:bg-primary-hover transition">Send message</button>
    </form>
</div>
@endsection
