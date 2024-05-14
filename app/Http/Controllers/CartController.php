<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Carts;
use App\Models\Tours;
use Auth;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::id();
        $profile = DB::table('profiles')
            ->select('profiles.id', 'profiles.user_id', 'profiles.address', 'profiles.phone_number', 'users.name', 'users.email')
            ->leftJoin('users', 'profiles.user_id', '=', 'users.id')
            ->where('user_id', $user)->first();

        $sort = $request->query('sort', 'all');

        $cartQuery = DB::table('carts')->select(
            'carts.id as cardId',
            'carts.total_price',
            'tickets.tickets_count',
            'tickets.date',
            'tours.name as name_tour',
            'tours.harga_tiket',
            'users.name',
            'carts.status'
        )
            ->Join('tickets', 'carts.id_ticket', '=', 'tickets.id')
            ->Join('tours', 'carts.id_tour', '=', 'tours.id')
            ->Join('users', 'tickets.id_users', '=', 'users.id')
            ->where('users.id', $user);

        if ($sort != 'all') {
            $cartQuery = $cartQuery->where('carts.status', $sort);
        }

        $cart = $cartQuery->paginate(5)->appends(['sort' => $sort]);

        return view('layout-users.transaksi')->with(['cart' => $cart, 'profile' => $profile]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $method = $request->method;
        $cart = DB::table('carts')->where('id', $request->id)->first();
        $tour = DB::table('tours')->where('id', $request->id)->first();
        $profile = DB::table('profiles')->where('id', $request->id)->first();

        if (!$cart || !$tour || !$profile) {

            return back()->withErrors('Entity not found.');
        }
        // $tripay = new TripayController();
        // $transaksi = $tripay->requestTransaksi($method, $profile, $cart, $tour);

        DB::table('payments')->insert([
            'id_user' => Auth::user()->id,
            'id_cart' => $cart->id,
            'id_tours' => $tour->id,
            'id_profile' => $profile->id,
            // 'reference' => $transaksi->reference,
            // 'merchant_ref' => $transaksi->merchant_ref,
            // 'total_amount' => $transaksi->amount,
            // 'status' => $transaksi->status,
        ]);

        return redirect()->route('cart.detail', [
            // 'reference' => $transaksi->reference,
        ])->with('success', 'Silakan melihat instruksi sebelum pembayaran ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::id();
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        // $ambi =  DB::table('carts')->find($id);

        $cart =  DB::table('carts')->select('carts.id', 'carts.total_price', 'tickets.tickets_count', 'tickets.date', 'tours.name as name_tour', 'tours.harga_tiket', 'users.name')
            ->Join('tickets', 'carts.id_ticket', '=', 'tickets.id')
            ->Join('tours', 'carts.id_tour', '=', 'tours.id')
            ->Join('users', 'tickets.id_users', '=', 'users.id')
            ->where('carts.id', $id)->where('users.id', $user)->first();

        //   dd($cart);

        return view('layout-users.checkout', ['cart' => $cart, 'channels' => $channels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request, $reference)
    {
        $tripay = new TripayController();
        $detail = $tripay->detailTransaksi($reference);

        // dd($detail);

        return view('layout-users.detailpembayaran', ['detail' => $detail]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carts $carts)
    {
        //
    }
}
