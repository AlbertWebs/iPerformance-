@extends('admin.layout')
@section('title', 'Bookings')
@section('heading', 'Course Bookings')
@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">View and filter training bookings. Search by name, email, M-Pesa reference or booking ID.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $bookings->total() }} booking(s)</p>
    </div>
</div>

<form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-6 flex flex-wrap items-end gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
    <div class="min-w-0 flex-1 sm:min-w-[200px]">
        <label for="search" class="block text-xs font-medium text-slate-500">Search</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name, email, ref, ID..." class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm placeholder:text-slate-400 focus:border-primary focus:ring-2 focus:ring-primary/20">
    </div>
    <div class="w-full sm:w-auto sm:min-w-[160px]">
        <label for="status" class="block text-xs font-medium text-slate-500">Status</label>
        <select name="status" id="status" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
            <option value="">All statuses</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
        </select>
    </div>
    <div class="flex flex-wrap gap-2">
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Filter
        </button>
        @if(request()->hasAny(['search', 'status']) && (request('search') || request('status')))
            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Clear</a>
        @endif
    </div>
</form>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Booking</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">User</th>
                    <th scope="col" class="hidden px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 lg:table-cell">Course</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Amount</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status</th>
                    <th scope="col" class="hidden px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 md:table-cell">M-Pesa ref</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($bookings as $b)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-medium text-slate-900">#{{ $b->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-slate-900">{{ $b->user->name ?? '—' }}</span>
                            <p class="mt-0.5 text-xs text-slate-500">{{ $b->user->email ?? '' }}</p>
                        </td>
                        <td class="hidden px-6 py-4 text-sm text-slate-600 lg:table-cell">{{ $b->bookable?->title ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">KES {{ number_format($b->amount, 0) }}</td>
                        <td class="px-6 py-4">
                            @if($b->status === 'paid')
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-800">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Paid
                                </span>
                            @elseif($b->status === 'failed')
                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800">Failed</span>
                            @else
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-800">Pending</span>
                            @endif
                        </td>
                        <td class="hidden px-6 py-4 font-mono text-sm text-slate-600 md:table-cell">{{ $b->mpesa_reference ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $b->created_at->format('M j, Y') }}<span class="hidden sm:inline"> · {{ $b->created_at->format('H:i') }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No bookings found</p>
                            <p class="mt-1 text-sm text-slate-500">
                                @if(request()->hasAny(['search', 'status']) && (request('search') || request('status')))
                                    Try changing or clearing the filters.
                                @else
                                    Bookings will appear here when users pay for trainings via the portal.
                                @endif
                            </p>
                            @if(request()->hasAny(['search', 'status']) && (request('search') || request('status')))
                                <a href="{{ route('admin.bookings.index') }}" class="mt-4 inline-flex items-center rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-hover">Clear filters</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $bookings->links() }}</div>
@endsection
