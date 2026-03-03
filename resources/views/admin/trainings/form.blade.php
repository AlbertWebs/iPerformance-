@php $training = $training ?? null; @endphp
<div class="space-y-8">
    {{-- Basics --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Basics</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="training_category_id" class="block text-sm font-medium text-slate-700">Category</label>
                <select name="training_category_id" id="training_category_id" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <option value="">— None —</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('training_category_id', $training?->training_category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $training?->title) }}" required placeholder="{{ $training ? '' : 'e.g. Certified HR Professional' }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('title')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                <p class="mt-1 text-xs text-slate-500">{{ $training ? 'Change with care if the page is already linked. Use From title to sync with title.' : 'Leave blank to auto-generate from title, or use the button to preview.' }}</p>
                <div class="mt-1.5 flex items-center gap-2">
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $training?->slug) }}" placeholder="{{ $training ? '' : 'certified-hr-professional' }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 font-mono text-sm placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <button type="button" id="slug-from-title" class="shrink-0 rounded-lg border border-slate-300 bg-slate-50 px-3 py-2.5 text-xs font-medium text-slate-600 transition hover:bg-slate-100" title="Generate from title">From title</button>
                </div>
                @error('slug')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('description', $training?->description) }}</textarea>
                @error('description')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Schedule --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Schedule</h3>
        <div class="mt-5 space-y-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-slate-700">Start date *</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $training?->start_date?->format('Y-m-d') ?? date('Y-m-d')) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('start_date')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-slate-700">End date *</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $training?->end_date?->format('Y-m-d') ?? date('Y-m-d', strtotime('+2 days'))) }}" required class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('end_date')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="location" class="block text-sm font-medium text-slate-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $training?->location) }}" placeholder="e.g. Nairobi or Virtual" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label for="time_slot" class="block text-sm font-medium text-slate-700">Time slot</label>
                    <input type="text" name="time_slot" id="time_slot" value="{{ old('time_slot', $training?->time_slot) }}" placeholder="e.g. 8:00 AM - 4:00 PM" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
            </div>
        </div>
    </div>

    {{-- Price & registration --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Price & registration</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="price" class="block text-sm font-medium text-slate-700">Price (KES)</label>
                <p class="mt-1 text-xs text-slate-500">Set a price to enable M-Pesa payment from the portal. Leave empty for no online payment.</p>
                <input type="number" name="price" id="price" value="{{ old('price', $training?->price) }}" step="1" min="0" placeholder="0" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('price')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="registration_link" class="block text-sm font-medium text-slate-700">Registration link</label>
                <input type="url" name="registration_link" id="registration_link" value="{{ old('registration_link', $training?->registration_link) }}" placeholder="https://..." class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('registration_link')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Image --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Image</h3>
        <div class="mt-5 space-y-4">
            @if($training?->image)
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ asset('storage/'.$training->image) }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-xl border border-slate-200 bg-slate-50 shadow-sm ring-1 ring-slate-900/5">
                        <img src="{{ asset('storage/'.$training->image) }}" alt="" class="h-24 w-auto max-w-[12rem] object-cover object-center" loading="lazy">
                    </a>
                    <div>
                        <p class="text-sm font-medium text-slate-700">Current image</p>
                        <a href="{{ asset('storage/'.$training->image) }}" target="_blank" rel="noopener" class="text-sm text-primary hover:text-primary-hover">View full size</a>
                    </div>
                </div>
                <p class="text-xs text-slate-500">Choose a new file to replace. Leave empty to keep the current image.</p>
            @endif
            <input type="file" name="image" id="image" accept="image/*" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary focus:border-primary focus:ring-2 focus:ring-primary/20">
            @error('image')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- Content (objectives, outline, audience) --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Content</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="objectives" class="block text-sm font-medium text-slate-700">Objectives</label>
                <textarea name="objectives" id="objectives" rows="3" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('objectives', $training?->objectives) }}</textarea>
            </div>
            <div>
                <label for="outline" class="block text-sm font-medium text-slate-700">Outline</label>
                <textarea name="outline" id="outline" rows="4" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('outline', $training?->outline) }}</textarea>
            </div>
            <div>
                <label for="target_audience" class="block text-sm font-medium text-slate-700">Target audience</label>
                <textarea name="target_audience" id="target_audience" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('target_audience', $training?->target_audience) }}</textarea>
            </div>
        </div>
    </div>

    {{-- Options --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Options</h3>
        <div class="mt-5 flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $training?->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                <label for="is_active" class="text-sm font-medium text-slate-700">Active (visible on site)</label>
            </div>
            <div class="w-32">
                <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $training?->sort_order ?? 0) }}" min="0" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
        </div>
    </div>

    {{-- SEO --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">SEO (optional)</h3>
        <div class="mt-5 space-y-5">
            <div>
                <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $training?->meta_title) }}" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('meta_description', $training?->meta_description) }}</textarea>
            </div>
        </div>
    </div>
</div>
