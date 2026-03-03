<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Certification;
use App\Models\Contact;
use App\Models\CertificateVerificationLog;
use App\Models\Review;
use App\Models\Training;
use App\Models\User;
use App\Models\Workshop;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalWorkshops' => Workshop::count(),
            'totalTrainings' => Training::count(),
            'totalCertifications' => Certification::count(),
            'totalReviews' => Review::count(),
            'totalUsers' => User::where('is_admin', false)->count(),
            'totalBookings' => Booking::count(),
            'paidBookings' => Booking::where('status', 'paid')->count(),
            'pendingContacts' => Contact::unread()->count(),
            'verificationSearches' => CertificateVerificationLog::count(),
        ]);
    }
}
