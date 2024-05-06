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
        $this->isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        $this->isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        $this->is3ds = env('MIDTRANS_IS_3DS', true);
    }

    public function createTransaction(Request $request)
    {
        $orderId = $this->generateUniqueOrderId($request);
        $payload = $this->preprocessTransactionDetails($orderId, $request);

        return $this->getTransactionToken($payload);
    }

    protected function generateUniqueOrderId(Request $request)
    {
        // Assuming you might want to include user or session details
        return 'ORDER-' . uniqid();
    }

    protected function preprocessTransactionDetails($orderId, Request $request)
    {
        return [
            "transaction_details" => [
                "order_id" => $orderId,
                "gross_amount" => $request->input('amount', 10000)
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
        $url = $this->isProduction ?
            "https://app.midtrans.com/snap/v1/transactions" :
            "https://app.sandbox.midtrans.com/snap/v1/transactions";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            'Content-Type' => 'application/json'
        ])->post($url, $payload);

        return $response->json();
    }
}