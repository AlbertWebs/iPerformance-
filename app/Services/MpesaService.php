<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('mpesa.env') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    public function getAccessToken(): ?string
    {
        $key = config('mpesa.consumer_key');
        $secret = config('mpesa.consumer_secret');
        if (! $key || ! $secret) {
            Log::warning('M-Pesa: consumer key or secret not set');
            return null;
        }

        $response = Http::withBasicAuth($key, $secret)
            ->get("{$this->baseUrl}/oauth/v1/generate?grant_type=client_credentials");

        if (! $response->successful()) {
            Log::error('M-Pesa token error', ['body' => $response->body()]);
            return null;
        }

        $data = $response->json();
        return $data['access_token'] ?? null;
    }

    /**
     * Initiate STK push (Lipa Na M-Pesa Online).
     * Phone format: 254XXXXXXXXX (no +).
     */
    public function stkPush(Booking $booking): array
    {
        $token = $this->getAccessToken();
        if (! $token) {
            return ['success' => false, 'message' => 'Could not get payment gateway access.'];
        }

        $shortcode = config('mpesa.shortcode');
        $passkey = config('mpesa.passkey');
        $callbackUrl = rtrim(config('mpesa.callback_base_url'), '/') . '/webhook/mpesa/callback';

        if (! $shortcode || ! $passkey) {
            Log::warning('M-Pesa: shortcode or passkey not set');
            return ['success' => false, 'message' => 'Payment gateway not configured.'];
        }

        $phone = $this->formatPhone($booking->mpesa_phone);
        if (! $phone) {
            return ['success' => false, 'message' => 'Invalid M-Pesa phone number.'];
        }

        $timestamp = date('YmdHis');
        $password = base64_encode($shortcode . $passkey . $timestamp);
        $amount = (int) round((float) $booking->amount);
        $ref = 'IPERF-' . $booking->id . '-' . substr(uniqid(), -6);

        $payload = [
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => $ref,
            'TransactionDesc' => 'Course booking #' . $booking->id,
        ];

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/mpesa/stkpush/v1/processrequest", $payload);

        $body = $response->json();

        if ($response->successful() && isset($body['CheckoutRequestID'])) {
            $booking->update([
                'mpesa_merchant_request_id' => $body['MerchantRequestID'] ?? null,
                'mpesa_checkout_request_id' => $body['CheckoutRequestID'],
            ]);
            return [
                'success' => true,
                'checkout_request_id' => $body['CheckoutRequestID'],
                'message' => 'Payment request sent. Complete the prompt on your phone.',
            ];
        }

        $err = $body['errorMessage'] ?? $body['error'] ?? $response->body();
        Log::error('M-Pesa STK push failed', ['response' => $body]);
        return [
            'success' => false,
            'message' => is_string($err) ? $err : 'Payment request failed. Please try again.',
        ];
    }

    public function formatPhone(?string $phone): ?string
    {
        if (! $phone) {
            return null;
        }
        $phone = preg_replace('/\D/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '254' . substr($phone, 1);
        } elseif (! str_starts_with($phone, '254')) {
            $phone = '254' . $phone;
        }
        return strlen($phone) === 12 ? $phone : null;
    }

    /**
     * Handle Daraja callback and update booking status.
     */
    public function handleCallback(array $data): void
    {
        $body = $data['Body'] ?? [];
        $stkCallback = $body['stkCallback'] ?? null;
        if (! $stkCallback) {
            return;
        }

        $checkoutRequestId = $stkCallback['CheckoutRequestID'] ?? null;
        $resultCode = (int) ($stkCallback['ResultCode'] ?? -1);
        $resultDesc = $stkCallback['ResultDesc'] ?? '';
        $callbackMetadata = $stkCallback['CallbackMetadata'] ?? null;

        $booking = Booking::where('mpesa_checkout_request_id', $checkoutRequestId)->first();
        if (! $booking) {
            Log::warning('M-Pesa callback: booking not found', ['CheckoutRequestID' => $checkoutRequestId]);
            return;
        }

        $mpesaRef = null;
        if ($callbackMetadata && is_array($callbackMetadata['Item'] ?? null)) {
            foreach ($callbackMetadata['Item'] as $item) {
                if (($item['Name'] ?? '') === 'MpesaReceiptNumber') {
                    $mpesaRef = $item['Value'] ?? null;
                    break;
                }
            }
        }

        $booking->update([
            'mpesa_result_code' => (string) $resultCode,
            'mpesa_result_desc' => $resultDesc,
            'mpesa_reference' => $mpesaRef,
            'status' => $resultCode === 0 ? 'paid' : 'failed',
        ]);
    }
}
