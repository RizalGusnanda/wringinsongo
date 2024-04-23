<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonfirmasiTiketController extends Controller
{
    public function index(Request $request)
    {
        return view('menu.konfirmasi-tiket.index');
    }
}
