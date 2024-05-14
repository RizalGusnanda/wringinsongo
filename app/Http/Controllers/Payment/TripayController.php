<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Mail\TripayTransactionSuccess;
use Illuminate\Http\Request;
use Mail;

class TripayController extends Controller
{
    public function getPaymentChannels()
    {


        $apiKey = config('tripay.api_key');
        // dd($apiKey);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        // dd(json_decode( $response)->data);

        return $response ? $response : $err;
    }

    public function requestTransaksi($method, $profile, $cart, $tour)
    {

        $apiKey       =  config('tripay.api_key');
        $privateKey   =  config('tripay.private_key');
        $merchantCode =  config('tripay.merchant_code');
        $merchantRef  = 'GL-' . time();
        // percobaan
        // dd($apiKey, $privateKey, $merchantCode, $merchantRef);
        $amount       = $cart->total_price;
        // dd($amount);

        $user = auth()->user();

        // user login customer yangn menyewa

        // manggil methode 
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $profile->phone_number,
            'order_items'    => [
                [
                    'name'        => $tour->name,
                    'price'       => $cart->total_price,
                    'quantity'    => 1,
                    // 'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    // 'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ],

            ],
            'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $cart->total_price, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        // dd($response);
        $response = json_decode($response)->data;

        // Cek jika respons transaksi sukses
        // Mengirim email setelah mendapatkan respons dari Tripay
        // Mail::to($user->email)->send(new TripayTransactionSuccess($data, $response));
        // dd($response);
        return $response ?: $err;
    }

    public function detailTransaksi($reference)
    {


        $apiKey = config('tripay.api_key');

        $payload = [
            'reference'    =>  $reference
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        // dd($response);

        return $response ?: $err;
    }
}