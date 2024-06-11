<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;

class ReservasiUserController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $status = $request->query('status', 'all');

        $reservasiQuery = Carts::with(['payments', 'tour', 'ticket', 'testimonis' => function ($query) use ($userId) {
            $query->where('id_users', $userId);
        }])
            ->whereHas('ticket', function ($query) use ($userId) {
                $query->where('id_users', $userId);
            });

        if ($status === 'aktif') {
            $reservasiQuery->where('status_confirm', 'pending');
        } elseif ($status === 'selesai') {
            $reservasiQuery->where('status_confirm', 'success');
        }

        $reservasi = $reservasiQuery->where('status', 'success')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['status' => $status]);

        foreach ($reservasi as $cart) {
            $cart->hasTestimonial = $cart->testimonis->isNotEmpty();
        }

        return view('layout-users.reservasi', compact('reservasi'));
    }

    public function showDetail($order_id)
{
    $payment = Payments::where('order_id', $order_id)
                ->with(['cart.tour', 'cart.ticket'])
                ->first();

    if (!$payment) {
        return redirect()->route('reservasi.index')->with('error', 'Reservasi tidak ditemukan.');
    }

    // Decode the JSON response
    $response = json_decode($payment->raw_response_response, true);

    // Additional tour and ticket details
    $tour = $payment->cart->tour;
    $ticket = $payment->cart->ticket;

    return view('layout-users.detailInvoice', compact('payment', 'response', 'tour', 'ticket'));
}

}