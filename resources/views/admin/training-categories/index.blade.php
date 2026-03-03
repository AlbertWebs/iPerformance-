@extends('admin.layout')
@section('title', 'Training Categories')
@section('heading', 'Training Categories')
@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Organize trainings by category (e.g. HR, Leadership). Used on the training calendar and detail pages.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $categories->total() }} categor{{ $categories->total() === 1 ? 'y' : 'ies' }}</p>
    </div>
    <a href="{{ route('admin.training-categories.create') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add category
    </a>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Category</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Slug</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Trainings</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Order</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Active</th>
                    <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($categories as $cat)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-900">{{ $cat->name }}</p>
                            @if($cat->description)
                                <p class="mt-0.5 line-clamp-1 text-xs text-slate-500">{{ $cat->description }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-sm text-slate-600">{{ $cat->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm {{ $cat->trainings_count > 0 ? 'font-medium text-slate-900' : 'text-slate-400' }}">{{ $cat->trainings_count }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $cat->sort_order }}</td>
                        <td class="px-6 py-4">
                            @if($cat->is_active)
                                <span class="inline-flex items-center gap-1 text-sm text-emerald-600">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Yes
                                </span>
                            @else
                                <span class="text-sm text-slate-400">No</span>
                            @endif
                        </td>
                        <td class="relative px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.training-categories.edit', $cat) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.training-categories.destroy', $cat) }}" class="inline" onsubmit="return confirm('Delete this category? This will fail if it has trainings.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-50" @if($cat->trainings_count > 0) title="Remove all trainings from this category first" @endif>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No categories yet</p>
                            <p class="mt-1 text-sm text-slate-500">Add a category to group your trainings (e.g. HR, Leadership).</p>
                            <a href="{{ route('admin.training-categories.create') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-hover">Add category</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($categories->hasPages())
    <div class="mt-6 flex justify-center">{{ $categories->links() }}</div>
@endif
@endsection
