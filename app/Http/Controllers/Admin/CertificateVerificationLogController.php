<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateVerificationLog;
use Illuminate\Http\Request;

class CertificateVerificationLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = CertificateVerificationLog::orderBy('created_at', 'desc')->paginate(50);
        return view('admin.verification-logs.index', compact('logs'));
    }
}
