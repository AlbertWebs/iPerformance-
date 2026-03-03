<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'phone' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'organization_email' => ['nullable', 'email', 'max:255'],
            'organization_location' => ['nullable', 'string', 'max:255'],
            'organization_phone' => ['nullable', 'string', 'max:50'],
            'accept_terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => false,
            'phone' => $data['phone'] ?? null,
            'position' => $data['position'] ?? null,
            'organization_name' => $data['organization_name'] ?? null,
            'organization_email' => $data['organization_email'] ?? null,
            'organization_location' => $data['organization_location'] ?? null,
            'organization_phone' => $data['organization_phone'] ?? null,
        ]);

        Auth::login($user);

        return redirect()->route('portal.dashboard')->with('success', 'Welcome! Your account has been created.');
    }
}
