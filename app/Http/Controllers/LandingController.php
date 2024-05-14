<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tours;

class LandingController extends Controller
{
    public function show()
    {
        $tours = Tours::take(4)->get();

        if ($tours->count() < 1) {
            $message = "Data Wisata Tidak Tersedia!";
            return view('layout-users/landingpage', compact('message'));
        }

        return view('layout-users/landingpage', compact('tours'));
    }
}
