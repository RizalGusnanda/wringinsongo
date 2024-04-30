<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendapatanWisataController extends Controller
{
    public function index(Request $request)
    {
        return view('menu.pendapatan-wisata.index');
    }
}
