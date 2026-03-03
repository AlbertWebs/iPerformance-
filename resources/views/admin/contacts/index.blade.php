@extends('admin.layout')
@section('title', 'Contacts')
@section('heading', 'Contact Submissions')
@section('content')
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-slate-500">Read</th>
                <th class="px-6 py-3 text-right text-xs font-medium uppercase text-slate-500">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($contacts as $c)
                <tr class="{{ $c->is_read ? '' : 'bg-primary/5' }}">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $c->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $c->email }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $c->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4">{{ $c->is_read ? 'Yes' : 'No' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.contacts.show', $c) }}" class="text-indigo-600 hover:text-indigo-800">View</a>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $c) }}" class="inline ml-2" onsubmit="return confirm('Delete this submission?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">No contact submissions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $contacts->links() }}</div>
@endsection
