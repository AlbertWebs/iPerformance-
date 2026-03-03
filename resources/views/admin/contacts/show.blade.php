@extends('admin.layout')
@section('title', 'View Contact')
@section('heading', 'Contact Submission')
@section('content')
<div class="max-w-2xl rounded-xl border border-slate-200 bg-white p-6 shadow">
    <dl class="space-y-4">
        <div>
            <dt class="text-sm font-medium text-slate-500">Name</dt>
            <dd class="mt-1 text-slate-900">{{ $contact->name }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-slate-500">Email</dt>
            <dd class="mt-1"><a href="mailto:{{ $contact->email }}" class="text-indigo-600 hover:underline">{{ $contact->email }}</a></dd>
        </div>
        @if($contact->phone)
        <div>
            <dt class="text-sm font-medium text-slate-500">Phone</dt>
            <dd class="mt-1 text-slate-900">{{ $contact->phone }}</dd>
        </div>
        @endif
        <div>
            <dt class="text-sm font-medium text-slate-500">Message</dt>
            <dd class="mt-1 whitespace-pre-wrap text-slate-900">{{ $contact->message }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-slate-500">Received</dt>
            <dd class="mt-1 text-slate-600">{{ $contact->created_at->format('F j, Y \a\t g:i A') }}</dd>
        </div>
    </dl>
    <div class="mt-6 flex gap-3">
        @if($contact->is_read)
            <form method="POST" action="{{ route('admin.contacts.unread', $contact) }}">
                @csrf
                <button type="submit" class="rounded-lg border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Mark Unread</button>
            </form>
        @endif
        <a href="{{ route('admin.contacts.index') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-700">Back to List</a>
        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline" onsubmit="return confirm('Delete this submission?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-lg border border-red-300 px-4 py-2 text-sm text-red-600 hover:bg-red-50">Delete</button>
        </form>
    </div>
</div>
@endsection
