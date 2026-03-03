@php $certification = $certification ?? null; @endphp
<div class="space-y-8">
    {{-- Basics --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Basics</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $certification?->title) }}" required placeholder="{{ $certification ? '' : 'e.g. Certified HR Professional (CHRP)' }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('title')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                <p class="mt-1 text-xs text-slate-500">{{ $certification ? 'Change with care if the page is already linked. Use From title to sync.' : 'Leave blank to auto-generate from title, or use the button to preview.' }}</p>
                <div class="mt-1.5 flex items-center gap-2">
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $certification?->slug) }}" placeholder="{{ $certification ? '' : 'certified-hr-professional' }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <button type="button" id="slug-from-title" class="shrink-0 rounded-lg border border-slate-300 bg-slate-50 px-3 py-2.5 text-xs font-medium text-slate-600 transition hover:bg-slate-100" title="Generate from title">From title</button>
                </div>
                @error('slug')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                <textarea name="description" id="description" rows="5" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Overview of the certification program...">{{ old('description', $certification?->description) }}</textarea>
                @error('description')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Details --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Details</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="duration" class="block text-sm font-medium text-slate-700">Duration</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $certification?->duration) }}" placeholder="e.g. 6 days or 3 months" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('duration')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="accreditation_details" class="block text-sm font-medium text-slate-700">Accreditation details</label>
                <textarea name="accreditation_details" id="accreditation_details" rows="3" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Accrediting body, validity, etc.">{{ old('accreditation_details', $certification?->accreditation_details) }}</textarea>
                @error('accreditation_details')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="requirements" class="block text-sm font-medium text-slate-700">Requirements</label>
                <textarea name="requirements" id="requirements" rows="3" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Eligibility or prerequisites...">{{ old('requirements', $certification?->requirements) }}</textarea>
                @error('requirements')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="apply_link" class="block text-sm font-medium text-slate-700">Apply link</label>
                <input type="url" name="apply_link" id="apply_link" value="{{ old('apply_link', $certification?->apply_link) }}" placeholder="https://..." class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('apply_link')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Image --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Image</h3>
        <div class="mt-5 space-y-4">
            @if($certification?->image)
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ asset('storage/'.$certification->image) }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 shadow-sm ring-1 ring-slate-900/5">
                        <img src="{{ asset('storage/'.$certification->image) }}" alt="" class="h-24 w-auto max-w-[12rem] object-cover object-center" loading="lazy">
                    </a>
                    <div>
                        <p class="text-sm font-medium text-slate-700">Current image</p>
                        <a href="{{ asset('storage/'.$certification->image) }}" target="_blank" rel="noopener" class="text-sm text-primary hover:text-primary-hover">View full size</a>
                    </div>
                </div>
                <p class="text-xs text-slate-500">Choose a new file to replace. Leave empty to keep the current image.</p>
            @endif
            <input type="file" name="image" id="image" accept="image/*" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary focus:border-primary focus:ring-2 focus:ring-primary/20">
            @error('image')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- Options --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Options</h3>
        <div class="mt-5 flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $certification?->is_featured ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                <label for="is_featured" class="text-sm font-medium text-slate-700">Featured (highlight on site)</label>
            </div>
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $certification?->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                <label for="is_active" class="text-sm font-medium text-slate-700">Active (visible on site)</label>
            </div>
            <div class="w-32">
                <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $certification?->sort_order ?? 0) }}" min="0" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
        </div>
    </div>

    {{-- SEO --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">SEO (optional)</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $certification?->meta_title) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('meta_description', $certification?->meta_description) }}</textarea>
            </div>
        </div>
    </div>
</div>
