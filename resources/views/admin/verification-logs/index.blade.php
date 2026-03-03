@extends('admin.layout')
@section('title', 'Verification Logs')
@section('heading', 'Certificate Verification Logs')
@section('content')
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Certificate Number</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Found</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">IP Address</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($logs as $log)
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                    <td class="px-6 py-4 text-sm font-mono text-slate-900">{{ $log->certificate_number }}</td>
                    <td class="px-6 py-4">
                        @if($log->found)
                            <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-xs text-emerald-800">Yes</span>
                        @else
                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs text-slate-700">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $log->ip_address ?? '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-slate-500">No verification searches yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $logs->links() }}</div>
@endsection
