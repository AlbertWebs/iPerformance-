@extends('admin.layout')
@section('title', 'Hero Section')
@section('heading', 'Hero Section')
@section('content')
<div class="max-w-3xl">
    @if($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <p class="font-medium">Please fix the following:</p>
            <ul class="mt-1 list-inside list-disc space-y-0.5">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif
    <nav class="mb-8 flex items-center gap-2 text-sm">
        <a href="{{ route('admin.settings.index') }}" class="text-slate-500 transition hover:text-primary">Settings</a>
        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="font-medium text-slate-700">Hero section</span>
    </nav>

    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-start sm:gap-6">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit hero section</h2>
            <p class="mt-1 text-sm text-slate-600">Update the headline, subtitle, buttons and image shown on the home page.</p>
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover">View home page</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data" id="hero-edit-form">
        @csrf
        @method('PUT')

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Headline &amp; text</h3>
            <div class="mt-5 space-y-5">
                <div>
                    <label for="tagline" class="block text-sm font-medium text-slate-700">Tagline</label>
                    <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $hero->tagline) }}" placeholder="e.g. HR Consulting & Certification" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="headline" class="block text-sm font-medium text-slate-700">Headline (before highlight)</label>
                        <input type="text" name="headline" id="headline" value="{{ old('headline', $hero->headline) }}" placeholder="e.g. HR excellence for" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label for="headline_highlight" class="block text-sm font-medium text-slate-700">Headline highlight word</label>
                        <input type="text" name="headline_highlight" id="headline_highlight" value="{{ old('headline_highlight', $hero->headline_highlight) }}" placeholder="e.g. Africa" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <p class="mt-1 text-xs text-slate-500">Shown in accent color after the headline.</p>
                    </div>
                </div>
                <div>
                    <label for="subtitle" class="block text-sm font-medium text-slate-700">Subtitle</label>
                    <textarea name="subtitle" id="subtitle" rows="3" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Short description under the headline...">{{ old('subtitle', $hero->subtitle) }}</textarea>
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Call-to-action buttons</h3>
            <p class="mt-1 text-xs text-slate-500">Use a route name (e.g. workshops.index) or full URL (https://...).</p>
            <div class="mt-5 space-y-5">
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="cta_1_text" class="block text-sm font-medium text-slate-700">Primary button text</label>
                        <input type="text" name="cta_1_text" id="cta_1_text" value="{{ old('cta_1_text', $hero->cta_1_text) }}" placeholder="View workshops" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label for="cta_1_url" class="block text-sm font-medium text-slate-700">Primary button URL / route</label>
                        <input type="text" name="cta_1_url" id="cta_1_url" value="{{ old('cta_1_url', $hero->cta_1_url) }}" placeholder="workshops.index" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="cta_2_text" class="block text-sm font-medium text-slate-700">Second button text</label>
                        <input type="text" name="cta_2_text" id="cta_2_text" value="{{ old('cta_2_text', $hero->cta_2_text) }}" placeholder="Training calendar" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label for="cta_2_url" class="block text-sm font-medium text-slate-700">Second button URL / route</label>
                        <input type="text" name="cta_2_url" id="cta_2_url" value="{{ old('cta_2_url', $hero->cta_2_url) }}" placeholder="trainings.index" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="cta_3_text" class="block text-sm font-medium text-slate-700">Third button text</label>
                        <input type="text" name="cta_3_text" id="cta_3_text" value="{{ old('cta_3_text', $hero->cta_3_text) }}" placeholder="Contact us" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label for="cta_3_url" class="block text-sm font-medium text-slate-700">Third button URL / route</label>
                        <input type="text" name="cta_3_url" id="cta_3_url" value="{{ old('cta_3_url', $hero->cta_3_url) }}" placeholder="contact" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Hero image</h3>
            <div class="mt-5 space-y-4">
                @if(!empty($hero->image))
                    <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4">
                        <p class="mb-3 text-sm font-medium text-slate-700">Current hero image (shown on home page)</p>
                        <a href="{{ asset('storage/'.$hero->image) }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm ring-1 ring-slate-900/5">
                            <img src="{{ asset('storage/'.$hero->image) }}" alt="Current hero" class="h-48 w-full max-w-md object-cover object-center sm:h-56" loading="lazy">
                        </a>
                        <p class="mt-2">
                            <a href="{{ asset('storage/'.$hero->image) }}" target="_blank" rel="noopener" class="text-sm font-medium text-primary hover:text-primary-hover">View full size</a>
                        </p>
                    </div>
                    <p class="text-xs text-slate-500">Upload a new image below to replace. Leave empty to keep the current image.</p>
                @else
                    <p class="text-sm text-slate-600">No image set. Upload one below, or the site will use the default placeholder on the home page.</p>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary focus:border-primary focus:ring-2 focus:ring-primary/20">
                <p class="mt-1 text-xs text-slate-500">Max 2 MB. JPG, PNG, GIF, WebP. If the image does not appear after saving, run <code class="rounded bg-slate-100 px-1 py-0.5 text-xs">php artisan storage:link</code> once.</p>
                @error('image')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                <div>
                    <label for="image_alt" class="block text-sm font-medium text-slate-700">Image alt text</label>
                    <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt', $hero->image_alt) }}" placeholder="HR excellence and professional development" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
            </div>
        </div>

        <div class="h-24 flex-shrink-0"></div>

        <div class="fixed bottom-0 left-0 right-0 z-20 border-t border-slate-200 bg-white/95 px-8 py-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] backdrop-blur sm:left-64">
            <div class="mx-auto flex max-w-3xl flex-wrap items-center justify-between gap-4">
                <a href="{{ url('/') }}" target="_blank" rel="noopener" class="text-sm font-medium text-primary hover:text-primary-hover">View home page</a>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save hero section
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
