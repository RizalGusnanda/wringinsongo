<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KonfirmasiTiketController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $query = Carts::where('status', 'success')->with(['payments', 'ticket.user', 'tour']);

        $search = $request->get('search');
        if ($search) {
            $query->where('status', 'success')
                ->where(function ($query) use ($search) {
                    $query->whereHas('ticket.user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('tour', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('payments', function ($q) use ($search) {
                        $q->where('order_id', 'like', '%' . $search . '%');
                    });
                });
        }

        $filter_status = $request->get('filter_status');
        if ($filter_status == 'now') {
            $query->whereHas('ticket', function ($q) {
                $q->whereDate('date', Carbon::now('Asia/Jakarta'));
            });
        }

        $carts = $query->paginate(10);

        return view('menu.konfirmasi-tiket.index', compact('carts', 'search', 'filter_status'));
    }


    public function confirm($id)
    {
        $cart = Carts::findOrFail($id);
        $cart->status_confirm = 'success';
        $cart->save();

        return redirect()->route('konfirmasi-tiket.index')->with('success', 'Status berhasil diubah!');
    }
}
