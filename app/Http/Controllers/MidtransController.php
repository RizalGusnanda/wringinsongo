<?php

namespace App\Http\Controllers;

use App\Helper\Midtrans;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    protected $midtransHelper;

    public function __construct(Midtrans $midtransHelper)
    {
        $this->midtransHelper = $midtransHelper;
    }

    public function initiatePayment(Request $request)
    {
        $response = $this->midtransHelper->createTransaction($request);
        return response()->json($response);
    }
}