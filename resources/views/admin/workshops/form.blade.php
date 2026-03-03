@php $workshop = $workshop ?? null; @endphp

<div class="space-y-8">
    {{-- Basics --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Basics</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $workshop?->title) }}" required placeholder="{{ $workshop ? '' : 'e.g. HR Fundamentals Workshop' }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('title')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="{{ $workshop ? '' : 'Brief overview for the workshops listing page.' }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('description', $workshop?->description) }}</textarea>
                @error('description')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="banner_image" class="block text-sm font-medium text-slate-700">Banner image</label>
                @if(!$workshop)
                    <p class="mt-1 text-xs text-slate-500">Optional. Recommended 1200×630px. Max 2MB.</p>
                @endif
                @if($workshop?->banner_image)
                    <p class="mt-1.5 text-sm text-slate-500">Current: <a href="{{ asset('storage/'.$workshop->banner_image) }}" target="_blank" class="font-medium text-primary hover:underline">View image</a></p>
                @endif
                <input type="file" name="banner_image" id="banner_image" accept="image/*" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('banner_image')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Schedule & location --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Schedule & location</h3>
        <div class="mt-5 grid gap-5 sm:grid-cols-2">
            <div>
                <label for="date" class="block text-sm font-medium text-slate-700">Date *</label>
                <input type="date" name="date" id="date" value="{{ old('date', $workshop?->date?->format('Y-m-d')) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('date')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-slate-700">Location *</label>
                <select name="location" id="location" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <option value="Physical" {{ old('location', $workshop?->location) === 'Physical' ? 'selected' : '' }}>Physical</option>
                    <option value="Virtual" {{ old('location', $workshop?->location) === 'Virtual' ? 'selected' : '' }}>Virtual</option>
                </select>
                @error('location')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="mt-5">
            <label for="registration_link" class="block text-sm font-medium text-slate-700">Registration link</label>
            <input type="url" name="registration_link" id="registration_link" value="{{ old('registration_link', $workshop?->registration_link) }}" placeholder="https://..." class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            @error('registration_link')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- Options --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Options</h3>
        <div class="mt-5 grid gap-5 sm:grid-cols-2">
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                <select name="status" id="status" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <option value="upcoming" {{ old('status', $workshop?->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="past" {{ old('status', $workshop?->status) === 'past' ? 'selected' : '' }}>Past</option>
                </select>
            </div>
            <div>
                <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $workshop?->sort_order ?? 0) }}" min="0" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
        </div>
        <div class="mt-5 flex items-center gap-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $workshop?->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
            <label for="is_active" class="text-sm font-medium text-slate-700">Active (visible on site)</label>
        </div>
    </div>

    {{-- SEO --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">SEO (optional)</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $workshop?->meta_title) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('meta_description', $workshop?->meta_description) }}</textarea>
            </div>
        </div>
    </div>
</div>
