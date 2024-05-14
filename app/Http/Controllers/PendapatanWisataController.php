<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tours;
use App\Exports\PendapatanWisataExport;
use Maatwebsite\Excel\Facades\Excel;

class PendapatanWisataController extends Controller
{
    public function index(Request $request)
    {
        $query = Tours::with(['carts' => function ($query) {
            $query->where('status', 'success')
                ->selectRaw('id_tour, sum(tickets.tickets_count) as total_tickets, sum(total_price) as total_pendapatan')
                ->join('tickets', 'carts.id_ticket', '=', 'tickets.id')
                ->groupBy('id_tour');
        }])->where('type', 'wisata bertiket');

        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $tours = $query->paginate(10);

        return view('menu.pendapatan-wisata.index', compact('tours'));
    }

    public function export(Request $request)
    {
        return Excel::download(new PendapatanWisataExport($request), 'pendapatan_wisata.xlsx');
    }
}
