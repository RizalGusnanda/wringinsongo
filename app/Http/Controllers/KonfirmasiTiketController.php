<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class KonfirmasiTiketController extends Controller
{
    public function index(Request $request)
    {
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

        $carts = $query->paginate(10);

        return view('menu.konfirmasi-tiket.index', compact('carts', 'search'));
    }


    public function confirm($id)
    {
        $cart = Carts::findOrFail($id);
        $cart->status_confirm = 'success';
        $cart->save();

        return redirect()->route('konfirmasi-tiket.index')->with('success', 'Status berhasil diubah!');
    }
}
