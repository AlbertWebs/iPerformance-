@extends('admin.layout')
@section('title', 'Certificates')
@section('heading', 'Issued Certificates')
@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Generate certificates with auto numbers (IPC-YEAR-NNNNN) or add manually. Print from the list or after generating.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $certificates->total() }} certificate(s)</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.certificates.generate') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Generate certificate
        </a>
        <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add manually
        </a>
    </div>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Certificate #</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Name</th>
                    <th scope="col" class="hidden px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 md:table-cell">Course</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Date issued</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status</th>
                    <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($certificates as $c)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4 font-mono text-sm font-medium text-slate-900">{{ $c->certificate_number }}</td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-slate-900">{{ $c->name }}</span>
                            @if($c->user)<p class="mt-0.5 text-xs text-slate-500">{{ $c->user->email }}</p>@endif
                        </td>
                        <td class="hidden px-6 py-4 text-sm text-slate-600 md:table-cell">{{ $c->course }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $c->date_issued->format('M j, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($c->status === 'valid')
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-800">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Valid
                                </span>
                            @elseif($c->status === 'expired')
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-800">Expired</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800">Revoked</span>
                            @endif
                        </td>
                        <td class="relative px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.certificates.print', $c) }}" target="_blank" rel="noopener" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Print</a>
                                <a href="{{ route('admin.certificates.edit', $c) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Edit</a>
                                <form method="POST" action="{{ route('admin.certificates.destroy', $c) }}" class="inline" onsubmit="return confirm('Delete this certificate?');">
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
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No certificates yet</p>
                            <p class="mt-1 text-sm text-slate-500">Generate a certificate or add one manually to get started.</p>
                            <div class="mt-6 flex flex-wrap justify-center gap-3">
                                <a href="{{ route('admin.certificates.generate') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-hover">Generate certificate</a>
                                <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Add manually</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $certificates->links() }}</div>
@endsection
