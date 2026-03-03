@extends('admin.layout')
@section('title', 'Trainings')
@section('heading', 'Trainings')
@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Manage training programs. Add or edit trainings and set prices for M-Pesa payment.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $trainings->total() }} training(s)</p>
    </div>
    <a href="{{ route('admin.trainings.create') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add training
    </a>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Training</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Category</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Dates</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Location</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Price</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Active</th>
                    <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($trainings as $t)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <a href="{{ route('trainings.show', $t) }}" target="_blank" class="font-medium text-slate-900 hover:text-primary">{{ $t->title }}</a>
                        </td>
                        <td class="px-6 py-4">
                            @if($t->category)
                                <span class="inline-flex rounded-full bg-primary/10 px-2.5 py-1 text-xs font-medium text-primary">{{ $t->category->name }}</span>
                            @else
                                <span class="text-sm text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $t->start_date->format('M j') }} – {{ $t->end_date->format('M j, Y') }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $t->location ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if(isset($t->price) && $t->price > 0)
                                <span class="font-medium text-slate-900">KES {{ number_format($t->price, 0) }}</span>
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($t->is_active)
                                <span class="inline-flex items-center gap-1 text-sm text-emerald-600">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Yes
                                </span>
                            @else
                                <span class="text-sm text-slate-400">No</span>
                            @endif
                        </td>
                        <td class="relative px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.trainings.edit', $t) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.trainings.destroy', $t) }}" class="inline" onsubmit="return confirm('Delete this training?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-50">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No trainings yet</p>
                            <p class="mt-1 text-sm text-slate-500">Add a training program to show on the calendar and allow bookings.</p>
                            <a href="{{ route('admin.trainings.create') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-hover">Add training</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($trainings->hasPages())
    <div class="mt-6 flex justify-center">{{ $trainings->links() }}</div>
@endif
@endsection
