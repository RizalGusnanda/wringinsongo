<?php

namespace App\Http\Controllers;

use App\Models\testimonis;
use App\Http\Requests\StoretestimonisRequest;
use App\Http\Requests\UpdatetestimonisRequest;
use App\Models\Tours;
use Illuminate\Http\Request;

class TestimonisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = auth()->id();
        $id_cart = $request->query('id_cart');
        $id_tour = $request->query('id_tour');

        $selectedTour = $id_tour ? Tours::with(['testimonis' => function ($q) use ($userId, $id_cart) {
            $q->where('id_users', $userId)->where('id_cart', $id_cart);
        }])->find($id_tour) : null;

        $wisataTidakBertiket = Tours::where('type', 'wisata tidak bertiket')->get();
        foreach ($wisataTidakBertiket as $wisata) {
            $wisata->hasTestimonial = Testimonis::where('id_tour', $wisata->id)
                ->where('id_cart', $id_cart)
                ->where('id_users', $userId)
                ->exists();
        }

        return view('layout-users.testimoni', compact('selectedTour', 'wisataTidakBertiket', 'id_cart'));
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
    public function store(Request $request)
    {
        $testimonial = new Testimonis;
        $testimonial->id_tour = $request->id_tour;
        $testimonial->id_cart = $request->id_cart;
        $testimonial->id_users = auth()->id();
        $testimonial->reviews = $request->testimoni;
        $testimonial->rating = $request->rating;
        $testimonial->save();

        return back()->with('success', 'Testimoni berhasil dikirim!');
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
