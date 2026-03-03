@php $service = $service ?? null; @endphp
<div class="space-y-8">
    {{-- Basics --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Basics</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $service?->title) }}" required placeholder="{{ $service ? '' : 'e.g. HR Consulting' }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('title')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                <p class="mt-1 text-xs text-slate-500">{{ $service ? 'Change with care if the page is already linked. Use From title to sync.' : 'Leave blank to auto-generate from title, or use the button to preview.' }}</p>
                <div class="mt-1.5 flex items-center gap-2">
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $service?->slug) }}" placeholder="{{ $service ? '' : 'hr-consulting' }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <button type="button" id="slug-from-title" class="shrink-0 rounded-lg border border-slate-300 bg-slate-50 px-3 py-2.5 text-xs font-medium text-slate-600 transition hover:bg-slate-100" title="Generate from title">From title</button>
                </div>
                @error('slug')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="short_description" class="block text-sm font-medium text-slate-700">Short description</label>
                <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $service?->short_description) }}" placeholder="One-line summary for listings" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('short_description')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="full_description" class="block text-sm font-medium text-slate-700">Full description</label>
                <textarea name="full_description" id="full_description" rows="6" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Full content for the service page...">{{ old('full_description', $service?->full_description) }}</textarea>
                @error('full_description')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Icon and image --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Icon and image</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="icon" class="block text-sm font-medium text-slate-700">Icon</label>
                <p class="mt-1 text-xs text-slate-500">Icon name or class (e.g. briefcase, chart-bar). Depends on your front-end icon set.</p>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $service?->icon) }}" placeholder="e.g. briefcase" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('icon')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-slate-700">Image</label>
                <div class="mt-1.5 space-y-4">
                    @if($service?->image)
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ asset('storage/'.$service->image) }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 shadow-sm ring-1 ring-slate-900/5">
                                <img src="{{ asset('storage/'.$service->image) }}" alt="" class="h-24 w-auto max-w-[12rem] object-cover object-center" loading="lazy">
                            </a>
                            <div>
                                <p class="text-sm font-medium text-slate-700">Current image</p>
                                <a href="{{ asset('storage/'.$service->image) }}" target="_blank" rel="noopener" class="text-sm text-primary hover:text-primary-hover">View full size</a>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500">Choose a new file to replace. Leave empty to keep the current image.</p>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                @error('image')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Options --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Options</h3>
        <div class="mt-5 flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service?->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                <label for="is_active" class="text-sm font-medium text-slate-700">Active (visible on site)</label>
            </div>
            <div class="w-32">
                <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $service?->sort_order ?? 0) }}" min="0" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
        </div>
    </div>

    {{-- SEO --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">SEO (optional)</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $service?->meta_title) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('meta_description', $service?->meta_description) }}</textarea>
            </div>
        </div>
    </div>
</div>
