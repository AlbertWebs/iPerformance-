@extends('admin.layout')
@section('title', 'Users')
@section('heading', 'Users')
@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Manage portal users. Edit profile and organization details or set administrator role.</p>
        <p class="mt-1 text-sm font-medium text-slate-500">{{ $users->total() }} user(s)</p>
    </div>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">User</th>
                    <th scope="col" class="hidden px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 md:table-cell">Email</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Role</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Bookings</th>
                    <th scope="col" class="relative px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($users as $u)
                    <tr class="transition hover:bg-slate-50/80">
                        <td class="px-6 py-4">
                            <span class="font-medium text-slate-900">{{ $u->name }}</span>
                            <p class="md:hidden mt-0.5 text-xs text-slate-500">{{ $u->email }}</p>
                        </td>
                        <td class="hidden px-6 py-4 text-sm text-slate-600 md:table-cell">{{ $u->email }}</td>
                        <td class="px-6 py-4">
                            @if($u->is_admin)
                                <span class="inline-flex rounded-full bg-primary/15 px-2.5 py-1 text-xs font-medium text-primary">Admin</span>
                            @else
                                <span class="text-sm text-slate-500">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $u->bookings_count }}</td>
                        <td class="relative px-6 py-4 text-right">
                            <a href="{{ route('admin.users.edit', $u) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <p class="mt-4 font-medium text-slate-900">No users yet</p>
                            <p class="mt-1 text-sm text-slate-500">Users are created when they register on the site.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $users->links() }}</div>
@endsection
