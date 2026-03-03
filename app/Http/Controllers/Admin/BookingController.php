<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'bookable'])->latest();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->whereHas('user', fn ($q2) => $q2->where('name', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%"))
                    ->orWhere('mpesa_reference', 'like', "%{$s}%")
                    ->orWhere('id', 'like', "%{$s}%");
            });
        }
        $bookings = $query->paginate(20)->withQueryString();
        return view('admin.bookings.index', compact('bookings'));
    }
}
