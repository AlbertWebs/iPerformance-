@extends('admin.layout')
@section('title', 'Services')
@section('heading', 'Services')
@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Manage services shown on the site. Reorder with sort order; only active services appear on the front.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $services->total() }} service(s)</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add service
    </a>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Service</th>
                    <th scope="col" class="hidden px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 sm:table-cell">Summary</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Order</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Active</th>
                    <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($services as $s)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <a href="{{ route('services.show', $s) }}" target="_blank" class="font-medium text-slate-900 hover:text-primary">{{ $s->title }}</a>
                        </td>
                        <td class="hidden px-6 py-4 text-sm text-slate-600 sm:table-cell">
                            {{ $s->short_description ? Str::limit($s->short_description, 50) : '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $s->sort_order ?? 0 }}</td>
                        <td class="px-6 py-4">
                            @if($s->is_active)
                                <span class="inline-flex items-center gap-1 text-sm text-emerald-600">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Yes
                                </span>
                            @else
                                <span class="text-sm text-slate-400">No</span>
                            @endif
                        </td>
                        <td class="relative px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $s) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $s) }}" class="inline" onsubmit="return confirm('Delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-50">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No services yet</p>
                            <p class="mt-1 text-sm text-slate-500">Add a service to display on the Services section of the site.</p>
                            <a href="{{ route('admin.services.create') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-hover">Add service</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $services->links() }}</div>
@endsection
