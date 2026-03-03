<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Workshop;

class PortalController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $upcomingWorkshops = Workshop::active()
            ->upcoming()
            ->orderBy('date')
            ->limit(5)
            ->get();

        $upcomingTrainings = Training::active()
            ->upcoming()
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        $myBookings = $user->bookings()
            ->with('bookable')
            ->latest()
            ->limit(10)
            ->get();

        $myCertificates = $user->certificates()
            ->latest('date_issued')
            ->limit(10)
            ->get();

        return view('portal.dashboard', [
            'user' => $user,
            'upcomingWorkshops' => $upcomingWorkshops,
            'upcomingTrainings' => $upcomingTrainings,
            'myBookings' => $myBookings,
            'myCertificates' => $myCertificates,
        ]);
    }
}
