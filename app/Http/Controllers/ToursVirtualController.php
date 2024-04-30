<?php

namespace App\Http\Controllers;

use App\Models\tours_virtual;
use App\Http\Requests\Storetours_virtualRequest;
use App\Http\Requests\Updatetours_virtualRequest;

class ToursVirtualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout-users.virtual');
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
     * @param  \App\Http\Requests\Storetours_virtualRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetours_virtualRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tours_virtual  $tours_virtual
     * @return \Illuminate\Http\Response
     */
    public function show(tours_virtual $tours_virtual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tours_virtual  $tours_virtual
     * @return \Illuminate\Http\Response
     */
    public function edit(tours_virtual $tours_virtual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetours_virtualRequest  $request
     * @param  \App\Models\tours_virtual  $tours_virtual
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetours_virtualRequest $request, tours_virtual $tours_virtual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tours_virtual  $tours_virtual
     * @return \Illuminate\Http\Response
     */
    public function destroy(tours_virtual $tours_virtual)
    {
        //
    }
}
