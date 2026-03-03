@extends('admin.layout')
@section('title', 'Reviews')
@section('heading', 'Reviews / Testimonials')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.reviews.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Add Review</a>
</div>
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Company</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Rating</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Active</th>
                <th class="px-6 py-3 text-right text-xs font-medium uppercase text-slate-500">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($reviews as $r)
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $r->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $r->company ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm">{{ $r->rating }} ★</td>
                    <td class="px-6 py-4">{{ $r->is_active ? 'Yes' : 'No' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.reviews.edit', $r) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                        <form method="POST" action="{{ route('admin.reviews.destroy', $r) }}" class="inline ml-2" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">No reviews yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reviews->links() }}</div>
@endsection
