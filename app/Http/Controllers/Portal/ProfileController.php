<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('portal.profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'organization_email' => ['nullable', 'string', 'email', 'max:255'],
            'organization_location' => ['nullable', 'string', 'max:255'],
            'organization_phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->fill($validated);
        $user->save();

        return redirect()->route('portal.dashboard')->with('success', 'Profile updated successfully.');
    }
}
