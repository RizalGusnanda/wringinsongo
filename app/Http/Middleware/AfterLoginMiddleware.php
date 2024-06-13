<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfterLoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $jumlahTiket = session('jumlah_tiket');
            $tanggalKunjungan = session('tanggal_kunjungan');

            if ($jumlahTiket) {
                session()->put('jumlah_tiket', $jumlahTiket);
            }

            if ($tanggalKunjungan) {
                session()->put('tanggal_kunjungan', $tanggalKunjungan);
            }
        }

        return $next($request);
    }
}


