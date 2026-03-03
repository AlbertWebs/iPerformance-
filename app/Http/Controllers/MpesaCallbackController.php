<?php

namespace App\Http\Controllers;

use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MpesaCallbackController extends Controller
{
    public function __invoke(Request $request, MpesaService $mpesa)
    {
        $mpesa->handleCallback($request->all());
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted'], Response::HTTP_OK);
    }
}
