<?php

namespace App\Http\Controllers;

use App\Helper\Midtrans;
use App\Models\Carts;
use App\Models\Payments;
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
        if ($response['status'] === 'success') {
            $transaction = Payments::create([
                'cart_id' => $request->input('cart_id'),
                'order_id' => $response['order_id'],
                'amount' => $request->input('amount'),
                'status' => 'pending',
                'payment_type' => 'midtrans',
                'raw_response_request' => json_encode($response)
            ]);
            return response()->json(['status' => 'success', 'token' => $response['token'], 'redirect_url' => $response['redirect_url']]);
        } else {
            // Handle error
            return response()->json(['status' => 'error', 'message' => $response['message']]);
        }
    }


    protected function handlePaymentResponse($response)
    {
        if (!isset($response['transaction_status'])) {
            return ['status' => 'error', 'message' => 'Respons transaksi tidak valid'];
        }

        $status = $response['transaction_status'];

        $transaction = Payments::updateOrCreate(
            ['order_id' => $response['order_id']],
            [
                'amount' => $response['gross_amount'],
                'status' => $status,
                'payment_type' => $response['payment_type'] ?? 'not specified',
                'raw_response_response' => json_encode($response)
            ]
        );

        switch ($status) {
            case 'settlement':
                $cart = Carts::where('id', $transaction->cart_id)->first();
                $cart->status = 'success';
                $cart->save();
                break;
            case 'pending':
                break;
            case 'deny':
            case 'cancel':
            case 'expire':
                break;
            default:
                break;
        }

        return ['status' => 'success', 'message' => 'Transaksi dicatat', 'data' => $transaction];
    }

    public function paymentCallback(Request $request)
    {
        $data = $request->all();
        $response = $this->handlePaymentResponse($data);
        return response()->json($response);
    }
}