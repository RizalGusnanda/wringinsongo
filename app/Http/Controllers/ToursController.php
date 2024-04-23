<?php

namespace App\Http\Controllers;

use App\Models\tours;
use App\Http\Requests\StoretoursRequest;
use App\Http\Requests\UpdatetoursRequest;
use Illuminate\Http\Request;


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

        if ($search) {
            $tours = Tours::where('name', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $tours = Tours::paginate(5);
        }

        if ($tours->isEmpty() && $search) {
            return view('layout-users.wisata', compact('tours', 'search'))->with('error', 'Destinasi Wisata tidak ditemukan!');
        }

        return view('layout-users.wisata', compact('tours', 'search'));
    }


    public function detail($id)
    {
        $tour = Tours::with('subimages')->find($id);
        if (!$tour) {
            abort(404);
        }
        return view('layout-users.detailWisata', compact('tour'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretoursRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function show(tours $tours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function edit(tours $tours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetoursRequest  $request
     * @param  \App\Models\tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetoursRequest $request, tours $tours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function destroy(tours $tours)
    {
        //
    }
}
