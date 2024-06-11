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
        if (isset($response['token'])) {
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

    public function createInvoice($invoiceData)
    // public function createInvoice()
    {
        $url = $this->isProduction
            ? "https://api.midtrans.com/v1/invoices"
            : "https://api.sandbox.midtrans.com/v1/invoices";
        // $invoiceData =
        //     // "order_id": "ORDER-666534ab67251",
        //     '
        //     {
        //         "order_id" : "7950c36a-d267-4f25-bb03-7a82b00z168t",
        //         "invoice_number" : "7128c81b-cde5-4c33-8777-4d1d0fcd6377",
        //         "due_date" : "2025-08-06 20:03:04 +0700",
        //         "invoice_date" : "2025-01-06 20:03:04 +0700",
        //          "customer_details": {
        //             "id": 2,
        //             "name": "user",
        //             "email": "user@gmail.com",
        //                 "phone" : "82313123123"

        //         },
        //         "payment_type" : "virtual_account",
        //         "reference": "reference",
        //         "item_details": [
        //             {
        //                 "item_id": "35",
        //                 "price": 10000,
        //                 "quantity": 2,
        //                 "description": "Kosong"
        //             }
        //         ],
        //         "notes": "Tidak Ada",
        //         "virtual_accounts": [
        //             {
        //             "bank": "bca_va"
        //             }
        //         ],
        //         "amount": {
        //             "vat": 10000,
        //             "discount": 0,
        //             "shipping": 0
        //         },
        //     ';
        // $invoiceData = [
        //     "order_id" => "7950c36a-d267-4f25-bb03-7a82b00z168",
        //     "invoice_number" => "7128c81b-cde5-4c33-8777-4d1d0fcd6377",
        //     "due_date" => "2025-08-06 20:03:04 +0700",
        //     "invoice_date" => "2025-01-06 20:03:04 +0700",
        //     "customer_details" => [
        //         "id" => 2,
        //         "name" => "user",
        //         "email" => "user@gmail.com",
        //     ],
        //     "payment_type" => "virtual_account",
        //     "reference" => "reference",
        //     "item_details" => [
        //         [
        //             "item_id" => "35",
        //             "price" => 10000,
        //             "quantity" => 2,
        //             "description" => "Kosong"
        //         ]
        //     ],
        //     "notes" => "Tidak Ada",
        //     "virtual_accounts" => [
        //         [
        //             "bank" => "bca_va"
        //         ]
        //     ],
        //     "amount" => [
        //         "vat" => 10000,
        //         "discount" => 0,
        //         "shipping" => 0
        //     ]
        // ];


        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            'Content-Type' => 'application/json',
        ])->post($url, $invoiceData);

        return $response->json();
        // return $response;
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
        $url = $this->isProduction
            ? "https://app.midtrans.com/snap/v1/transactions"
            : "https://app.sandbox.midtrans.com/snap/v1/transactions";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            'Content-Type' => 'application/json'
        ])->post($url, $payload);

        return $response->json();
    }
}