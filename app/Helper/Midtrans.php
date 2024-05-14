<?php

namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Midtrans
{
    protected $serverKey;
    protected $clientKey;
    protected $isProduction;
    protected $isSanitized;
    protected $is3ds;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        $this->isProduction = env('MIDTRANS_IS_PRODUCTION');
        $this->isSanitized = env('MIDTRANS_IS_SANITIZED');
        $this->is3ds = env('MIDTRANS_IS_3DS');
    }

    public function createTransaction(Request $request)
    {
        $orderId = $this->generateUniqueOrderId($request);
        $payload = $this->preprocessTransactionDetails($orderId, $request);
        $response = $this->getTransactionToken($payload);
        // dd($res)
        if (isset($response['token'])) {
            // Ensure the order_id is also returned as part of the response for later use
            return [
                'status' => 'success',
                'token' => $response['token'],
                'redirect_url' => $response['redirect_url'],
                'order_id' => $orderId,
            ];
        } else {
            return ['status' => 'error', 'message' => 'Failed to create transaction', 'data' => $response];
        }
    }


    protected function generateUniqueOrderId(Request $request)
    {
        return 'ORDER-' . uniqid();
    }

    protected function preprocessTransactionDetails($orderId, Request $request)
    {
        return [
            "transaction_details" => [
                "order_id" => $orderId,
                "gross_amount" => $request->input('amount')
            ],
            "credit_card" => [
                "secure" => $this->is3ds
            ],
            "customer_details" => [
                "first_name" => $request->input('first_name', 'Customer'),
                "last_name" => $request->input('last_name', ''),
                "email" => $request->input('email', 'customer@example.com'),
                "phone" => $request->input('phone', '081234567890')
            ]
        ];
    }

    protected function getTransactionToken(array $payload)
    {
        $url =
            // $this->isProduction ?
            "https://app.midtrans.com/snap/v1/transactions";
        // :"https://app.sandbox.midtrans.com/snap/v1/transactions";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            'Content-Type' => 'application/json'
        ])->post($url, $payload);

        return $response->json();
    }
}