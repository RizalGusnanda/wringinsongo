<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiWisataController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');

        $reservations = DB::table('carts')
            ->join('tickets', 'carts.id_ticket', '=', 'tickets.id')
            ->join('tours', 'carts.id_tour', '=', 'tours.id')
            ->join('users', 'tickets.id_users', '=', 'users.id')
            ->select(
                'carts.id as cart_id',
                'users.name as user_name',
                'tours.name as tour_name',
                'tours.harga_tiket',
                'tickets.tickets_count',
                'carts.total_price',
                'tickets.date',
                'carts.status'
            )
            ->where(function ($query) {
                $query->where('carts.status', 'success')
                      ->orWhere('carts.status', 'pending');
            })
            ->where(function ($query) use ($search) {
                $query->where('users.name', 'like', "%$search%")
                    ->orWhere('tours.name', 'like', "%$search%");
            })
            ->paginate(10);

        return view('menu.reservasi-wisata.index', compact('reservations'));
    }

    public function create()
    {
        return view('menu.reservasi-wisata.create');
    }
}
