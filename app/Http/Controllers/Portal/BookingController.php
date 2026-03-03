<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Training;
use App\Models\Workshop;
use App\Services\MpesaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Step 1: Register / create booking.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:training,workshop'],
            'id' => ['required', 'integer', 'min:1'],
            'mpesa_phone' => ['required', 'string', 'min:9', 'max:15'],
        ]);

        $user = $request->user();
        $bookable = $this->resolveBookable($validated['type'], $validated['id']);
        if (! $bookable) {
            return response()->json(['message' => 'Course not found or not available.'], 404);
        }

        $amount = $this->getAmount($bookable);
        if ($amount === null || $amount <= 0) {
            return response()->json(['message' => 'This course is not available for online payment.'], 422);
        }

        // Optional: prevent duplicate pending booking for same user+course
        $existing = Booking::where('user_id', $user->id)
            ->where('bookable_type', get_class($bookable))
            ->where('bookable_id', $bookable->id)
            ->whereIn('status', ['pending', 'paid'])
            ->first();
        if ($existing) {
            if ($existing->isPaid()) {
                return response()->json(['message' => 'You have already booked this course.'], 422);
            }
            return response()->json([
                'booking_id' => $existing->id,
                'amount' => (float) $existing->amount,
                'course_title' => $this->getTitle($bookable),
                'step' => 2,
            ]);
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'bookable_type' => get_class($bookable),
            'bookable_id' => $bookable->id,
            'amount' => $amount,
            'mpesa_phone' => (new MpesaService)->formatPhone($validated['mpesa_phone']),
            'status' => 'pending',
        ]);

        return response()->json([
            'booking_id' => $booking->id,
            'amount' => (float) $booking->amount,
            'course_title' => $this->getTitle($bookable),
            'step' => 2,
        ]);
    }

    /**
     * Step 2: Trigger M-Pesa STK push.
     */
    public function pay(Request $request, Booking $booking, MpesaService $mpesa): JsonResponse
    {
        if ($booking->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }
        if ($booking->isPaid()) {
            return response()->json(['message' => 'Already paid.', 'status' => 'paid'], 200);
        }
        if ($booking->isFailed()) {
            return response()->json(['message' => 'Previous payment failed. Please try again.'], 422);
        }

        $result = $mpesa->stkPush($booking);
        if (! $result['success']) {
            return response()->json(['message' => $result['message']], 422);
        }

        return response()->json([
            'message' => $result['message'],
            'checkout_request_id' => $result['checkout_request_id'] ?? null,
        ]);
    }

    /**
     * Poll booking status (for AJAX).
     */
    public function status(Request $request, Booking $booking): JsonResponse
    {
        if ($booking->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        return response()->json([
            'status' => $booking->status,
            'mpesa_reference' => $booking->mpesa_reference,
            'course_title' => $this->getTitle($booking->bookable),
        ]);
    }

    private function resolveBookable(string $type, int $id): Training|Workshop|null
    {
        return match ($type) {
            'training' => Training::active()->upcoming()->find($id),
            'workshop' => Workshop::active()->upcoming()->find($id),
            default => null,
        };
    }

    private function getAmount(Training|Workshop $model): ?float
    {
        $price = $model->price ?? null;
        return $price !== null && $price > 0 ? (float) $price : null;
    }

    private function getTitle(Training|Workshop $model): string
    {
        return $model->title ?? 'Course';
    }
}
