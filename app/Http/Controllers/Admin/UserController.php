<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('bookings')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $user->loadCount('bookings');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'organization_email' => ['nullable', 'email', 'max:255'],
            'organization_location' => ['nullable', 'string', 'max:255'],
            'organization_phone' => ['nullable', 'string', 'max:50'],
        ];
        if ($request->user()->id !== $user->id) {
            $rules['is_admin'] = ['boolean'];
        }
        $data = $request->validate($rules);
        if (isset($data['is_admin'])) {
            $data['is_admin'] = (bool) $request->input('is_admin');
        }
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
