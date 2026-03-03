@extends('admin.layout')
@section('title', 'Certifications')
@section('heading', 'HR Certifications')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.certifications.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Add Certification</a>
</div>
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Duration</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Featured</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Active</th>
                <th class="px-6 py-3 text-right text-xs font-medium uppercase text-slate-500">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($certifications as $c)
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-900">{{ $c->title }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $c->duration ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $c->is_featured ? 'Yes' : 'No' }}</td>
                    <td class="px-6 py-4">{{ $c->is_active ? 'Yes' : 'No' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.certifications.edit', $c) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                        <form method="POST" action="{{ route('admin.certifications.destroy', $c) }}" class="inline ml-2" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">No certifications yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $certifications->links() }}</div>
@endsection
