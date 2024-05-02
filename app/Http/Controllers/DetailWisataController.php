<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Carts;
use App\Models\Tours;
use Illuminate\Support\Facades\Auth;

class DetailWisataController extends Controller
{
    public function index($id)
    {
        $tour = Tours::findOrFail($id);
        return view('layout-users.detailWisata', compact('tour'));
    }

    public function reserveTicket(Request $request, $id)
    {
        $tour = Tours::findOrFail($id);

        $ticket = new Tickets();
        $ticket->id_users = Auth::id();
        $ticket->id_tours = $id;
        $ticket->date = $request->tanggal_kunjungan;
        $ticket->tickets_count = $request->jumlah_tiket;
        $ticket->save();

        $total_price = $request->jumlah_tiket * $tour->harga_tiket;

        $cart = new Carts();
        $cart->id_ticket = $ticket->id;
        $cart->id_tour = $ticket->id_tours;
        $cart->total_price = $total_price;
        $cart->save();

        return redirect()->route('cart.store', ['id' => $cart->id])->with('success', 'Silakan melihat instruksi sebelum pembayaran');
    }
}
