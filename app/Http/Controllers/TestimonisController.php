<?php

namespace App\Http\Controllers;

use App\Models\testimonis;
use App\Http\Requests\StoretestimonisRequest;
use App\Http\Requests\UpdatetestimonisRequest;

class TestimonisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoretestimonisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretestimonisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\testimonis  $testimonis
     * @return \Illuminate\Http\Response
     */
    public function show(testimonis $testimonis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\testimonis  $testimonis
     * @return \Illuminate\Http\Response
     */
    public function edit(testimonis $testimonis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetestimonisRequest  $request
     * @param  \App\Models\testimonis  $testimonis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetestimonisRequest $request, testimonis $testimonis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\testimonis  $testimonis
     * @return \Illuminate\Http\Response
     */
    public function destroy(testimonis $testimonis)
    {
        //
    }
}
