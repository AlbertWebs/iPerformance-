<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\CertificateVerificationLog;
use App\Models\PageMeta;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function show()
    {
        $meta = PageMeta::where('page_key', 'verify')->first();
        return view('verify', [
            'meta_title' => $meta?->meta_title,
            'meta_description' => $meta?->meta_description,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'certificate_number' => ['required', 'string', 'max:255'],
        ]);

        $number = $request->certificate_number;
        $certificate = Certificate::where('certificate_number', $number)->first();

        CertificateVerificationLog::create([
            'certificate_number' => $number,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'found' => (bool) $certificate,
        ]);

        if ($certificate) {
            return redirect()->route('verify.result')->with('certificate', $certificate);
        }

        return redirect()->route('verify.result')->with('not_found', $number);
    }

    public function result(Request $request)
    {
        $certificate = $request->session()->get('certificate');
        $notFound = $request->session()->get('not_found');
        $meta = PageMeta::where('page_key', 'verify')->first();

        if (! $certificate && ! $notFound) {
            return redirect()->route('verify');
        }

        return view('verify-result', [
            'certificate' => $certificate,
            'notFound' => $notFound,
            'meta_title' => $meta?->meta_title,
            'meta_description' => $meta?->meta_description,
        ]);
    }
}
