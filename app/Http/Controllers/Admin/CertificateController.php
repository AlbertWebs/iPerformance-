<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(Request $request): View
    {
        $certificates = Certificate::with('user')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.certificates.index', compact('certificates'));
    }

    public function generate(): View
    {
        $users = User::where('is_admin', false)->orderBy('name')->get(['id', 'name', 'email']);
        $nextNumber = Certificate::generateCertificateNumber();

        return view('admin.certificates.generate', compact('users', 'nextNumber'));
    }

    public function storeGenerated(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'date_issued' => ['required', 'date'],
        ]);

        $certificate_number = Certificate::generateCertificateNumber(
            $request->date_issued ? (int) date('Y', strtotime($request->date_issued)) : null
        );

        $certificate = Certificate::create([
            'user_id' => $data['user_id'] ?? null,
            'certificate_number' => $certificate_number,
            'name' => $data['name'],
            'course' => $data['course'],
            'date_issued' => $data['date_issued'],
            'status' => 'valid',
        ]);

        return redirect()->route('admin.certificates.print', $certificate)
            ->with('success', 'Certificate generated. You can print it below.');
    }

    public function print(Certificate $certificate): View
    {
        return view('admin.certificates.print', compact('certificate'));
    }

    public function create(): View
    {
        $users = User::where('is_admin', false)->orderBy('name')->get(['id', 'name']);
        $nextNumber = Certificate::generateCertificateNumber();

        return view('admin.certificates.create', compact('users', 'nextNumber'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'certificate_number' => ['required', 'string', 'max:255', 'unique:certificates,certificate_number'],
            'name' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'date_issued' => ['required', 'date'],
            'status' => ['required', 'string', 'in:valid,expired,revoked'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);
        Certificate::create($data);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate added successfully.');
    }

    public function edit(Certificate $certificate): View
    {
        $users = User::where('is_admin', false)->orderBy('name')->get(['id', 'name']);
        return view('admin.certificates.edit', compact('certificate', 'users'));
    }

    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $data = $request->validate([
            'certificate_number' => ['required', 'string', 'max:255', 'unique:certificates,certificate_number,' . $certificate->id],
            'name' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'date_issued' => ['required', 'date'],
            'status' => ['required', 'string', 'in:valid,expired,revoked'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);
        $certificate->update($data);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
