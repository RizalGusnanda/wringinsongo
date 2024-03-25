<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasiWisataController extends Controller
{

    public function index(Request $request)
    {
        return view('menu.reservasi-wisata.index');
    }

    public function create()
    {
        return view('menu.reservasi-wisata.create');
    }
}
