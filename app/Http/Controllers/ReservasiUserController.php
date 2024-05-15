<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
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
        ->paginate(5);

        foreach ($reservasi as $cart) {
            $cart->hasTestimonial = $cart->testimonis->isNotEmpty();
        }

        return view('layout-users.reservasi', compact('reservasi'));
    }
}
