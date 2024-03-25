<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailWisataController extends Controller
{
    public function index()
    {
        return view('layout-users.detailWisata');
    }

}
