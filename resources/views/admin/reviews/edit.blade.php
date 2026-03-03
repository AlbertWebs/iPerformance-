@extends('admin.layout')
@section('title', 'Edit Review')
@section('heading', 'Edit Review')
@section('content')
<form method="POST" action="{{ route('admin.reviews.update', $review) }}" enctype="multipart/form-data" class="max-w-2xl space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $review->name) }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">
            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="company" class="block text-sm font-medium text-slate-700">Company</label>
            <input type="text" name="company" id="company" value="{{ old('company', $review->company) }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">
        </div>
    </div>
    <div>
        <label for="image" class="block text-sm font-medium text-slate-700">Image</label>
        @if($review->image)
            <p class="mt-1 text-sm text-slate-500">Current: <a href="{{ asset('storage/'.$review->image) }}" target="_blank" class="text-indigo-600">View</a></p>
        @endif
        <input type="file" name="image" id="image" accept="image/*" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">
    </div>
    <div>
        <label for="rating" class="block text-sm font-medium text-slate-700">Rating (1-5) *</label>
        <select name="rating" id="rating" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">
            @for($i=1;$i<=5;$i++)
                <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>{{ $i }} Star(s)</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="content" class="block text-sm font-medium text-slate-700">Testimonial *</label>
        <textarea name="content" id="content" rows="5" required class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">{{ old('content', $review->content) }}</textarea>
        @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="flex items-center gap-4">
        <label class="flex items-center">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $review->is_active) ? 'checked' : '' }} class="rounded border-slate-300 text-indigo-600">
            <span class="ml-2 text-sm text-slate-700">Active</span>
        </label>
        <div>
            <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort Order</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $review->sort_order) }}" min="0" class="mt-1 w-24 rounded-lg border border-slate-300 px-4 py-2">
        </div>
    </div>
    <div class="flex gap-3">
        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Update</button>
        <a href="{{ route('admin.reviews.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
</form>
@endsection
