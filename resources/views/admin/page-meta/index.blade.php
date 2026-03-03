@extends('admin.layout')
@section('title', 'SEO / Page Meta')
@section('heading', 'SEO & Page Meta')
@section('content')
<form method="POST" action="{{ route('admin.page-meta.update') }}" class="space-y-8">
    @csrf
    @method('PUT')
    @foreach($pageKeys as $key => $label)
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">{{ $label }}</h2>
            <div class="space-y-4">
                <div>
                    <label for="meta_title_{{ $key }}" class="block text-sm font-medium text-slate-700">Meta Title</label>
                    <input type="text" name="meta_title[{{ $key }}]" id="meta_title_{{ $key }}" value="{{ old("meta_title.{$key}", $pages->get($key)?->meta_title) }}" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">
                </div>
                <div>
                    <label for="meta_description_{{ $key }}" class="block text-sm font-medium text-slate-700">Meta Description</label>
                    <textarea name="meta_description[{{ $key }}]" id="meta_description_{{ $key }}" rows="2" class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2">{{ old("meta_description.{$key}", $pages->get($key)?->meta_description) }}</textarea>
                </div>
            </div>
        </div>
    @endforeach
    <div class="flex gap-3">
        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Save All</button>
        <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-slate-700 hover:bg-slate-50">Back to Dashboard</a>
    </div>
</form>
@endsection
