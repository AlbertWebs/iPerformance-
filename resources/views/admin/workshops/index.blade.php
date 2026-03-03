@extends('admin.layout')

@section('title', 'HR Workshops')
@section('heading', 'HR Workshops')

@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Manage workshops and events. Add new workshops or edit existing ones.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $workshops->total() }} workshop(s)</p>
    </div>
    <a href="{{ route('admin.workshops.create') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Workshop
    </a>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Workshop</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Date</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Location</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Active</th>
                    <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($workshops as $workshop)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-900">{{ $workshop->title }}</p>
                            @if($workshop->registration_link)
                                <p class="mt-0.5 text-xs text-slate-500">Has registration link</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $workshop->date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 text-sm text-slate-600">
                                @if($workshop->location === 'Virtual')
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @else
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                @endif
                                {{ $workshop->location }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $workshop->status === 'upcoming' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $workshop->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($workshop->is_active)
                                <span class="inline-flex items-center gap-1 text-sm text-emerald-600">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Yes
                                </span>
                            @else
                                <span class="text-sm text-slate-400">No</span>
                            @endif
                        </td>
                        <td class="relative px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.workshops.edit', $workshop) }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.workshops.destroy', $workshop) }}" class="inline" onsubmit="return confirm('Delete this workshop?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-50">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No workshops yet</p>
                            <p class="mt-1 text-sm text-slate-500">Get started by adding your first workshop.</p>
                            <a href="{{ route('admin.workshops.create') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-hover">Add Workshop</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($workshops->hasPages())
    <div class="mt-6 flex justify-center">{{ $workshops->links() }}</div>
@endif
@endsection
