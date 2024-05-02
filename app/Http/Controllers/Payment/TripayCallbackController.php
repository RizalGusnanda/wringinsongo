<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class TripayCallbackController extends Controller
{

    // Isi dengan private key anda
    protected $privateKey = 'euGfa-JVkvk-xSA1h-XSkER-ZzkmV';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return 'Invalid signature';
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return 'Invalid callback event, no action was taken';
        }

        $data = json_decode($json);
        $reference = $data->reference;
        $status = strtoupper((string) $data->status);

        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk closed payment
        |--------------------------------------------------------------------------
        */
        if (1 === (int) $data->is_closed_payment) {

            $transaksi = DB::table('payments')->select('payments.*')->where('payments.reference', $reference)->first();

            if (!$transaksi) {
                return 'No $transaksi found for this unique ref: ' . $reference;
            }

            DB::table('payments')->where('reference', $reference)->update(['status' => $status]);
            return response()->json(['success' => true]);
        }


        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk open payment
        |--------------------------------------------------------------------------
        */
        $transaksi = DB::table('payments')->select('payments.*')->where('payments.reference', $reference)->where('payments.status', 'UNPAID')->first();
        if (!$transaksi) {
            return '$transaksi not found or current status is not UNPAID';
        }

        if ((int) $data->total_amount !== (int) $transaksi->total_amount) {
            return 'Invalid amount, Expected: ' . $transaksi->total_amount . ' - Received: ' . $data->total_amount;
        }

        switch ($data->status) {
            case 'PAID':
                DB::table('payments')->where('reference', $reference)->update(['status' => 'PAID']);
                return response()->json(['success' => true]);

            case 'EXPIRED':
                DB::table('payments')->where('reference', $reference)->update(['status' => 'UNPAID']);
                return response()->json(['success' => true]);

            case 'FAILED':
                DB::table('payments')->where('reference', $reference)->update(['status' => 'UNPAID']);
                return response()->json(['success' => true]);

            default:
                return response()->json(['error' => 'Unrecognized payment status']);
        }
    }
}
