<?php

namespace App\Http\Controllers;

use App\Models\Tours;
use App\Http\Requests\StoretoursRequest;
use App\Http\Requests\UpdatetoursRequest;
use App\Models\Carts;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('wisata');
        $sort = $request->query('sort');

        $query = Tours::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($sort == 'ascending') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'descending') {
            $query->orderBy('name', 'desc');
        }

        $tours = $query->paginate(5);

        $error = null;
        if ($tours->isEmpty()) {
            $error = $search ? 'Destinasi Wisata tidak ditemukan!' : 'Destinasi wisata belum ditambahkan!';
        }

        return view('layout-users.wisata', compact('tours', 'search', 'sort', 'error'));
    }



    public function detail($id, Request $request)
    {
        $tour = Tours::with(['subimages', 'testimonis.user'])->find($id);
        if (!$tour) {
            abort(404);
        }

        $averageRating = $tour->testimonis()->average('rating');
        $averageRating = round($averageRating * 2) / 2;

        $testimonials = $tour->testimonis()->with('user')->paginate(5);

        // Ambil data dari session jika ada
        $jumlahTiket = session('jumlah_tiket', 1);
        $tanggalKunjungan = session('tanggal_kunjungan', null);

        if ($request->ajax()) {
            return view('partials.testimonials', compact('testimonials'))->render();
        }

        return view('layout-users.detailWisata', compact('tour', 'averageRating', 'testimonials', 'jumlahTiket', 'tanggalKunjungan'));
    }

    public function storeReservation(Request $request, $tour_id)
{
    if (!Auth::check()) {
        $request->session()->put('jumlah_tiket', $request->jumlah_tiket);
        $request->session()->put('tanggal_kunjungan', $request->tanggal_kunjungan);

        return redirect()->route('login')->with('error', 'Silahkan login untuk melakukan reservasi.');
    }

    $user = Auth::user();
    $profile = $user->profile;

    if (!$profile || !$profile->isComplete()) {
        return redirect()->route('profile.index')->with('error', 'Silahkan lengkapi profile anda terlebih dahulu.');
    }

    $tour = Tours::findOrFail($tour_id);

    $ticket = new Tickets([
        'id_users' => $user->id,
        'id_tours' => $tour_id,
        'date' => $request->tanggal_kunjungan,
        'tickets_count' => $request->jumlah_tiket,
    ]);
    $ticket->save();

    $total_price = $tour->harga_tiket * $request->jumlah_tiket;

    $cart = new Carts([
        'id_ticket' => $ticket->id,
        'id_tour' => $tour_id,
        'total_price' => $total_price,
        'status' => 'pending',
    ]);
    $cart->save();

    // Hapus data dari session setelah berhasil membuat reservasi
    $request->session()->forget('jumlah_tiket');
    $request->session()->forget('tanggal_kunjungan');

    return redirect()->route('cart.store')->with('success', 'Reservasi berhasil dibuat.');
}


}
