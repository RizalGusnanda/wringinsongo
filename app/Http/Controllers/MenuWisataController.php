<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatetoursRequest;
use Illuminate\Http\Request;
use App\Models\Tours;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Imports\ToursImport;
use Maatwebsite\Excel\Facades\Excel;

class MenuWisataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:menu-wisata.index')->only('index');
        $this->middleware('permission:menu-wisata.create')->only('create', 'store');
        $this->middleware('permission:menu-wisata.edit')->only('edit', 'update');
        $this->middleware('permission:menu-wisata.destroy')->only('destroy');
    }


    public function index(Request $request)
    {
        $search = $request->get('search');

        if (!empty($search)) {
            $tours = Tours::where('name', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $tours = Tours::paginate(5);
        }

        return view('menu.menu-wisata.index', ['tours' => $tours]);
    }


    public function create()
    {
        return view('menu.menu-wisata.create');
    }

    public function store(UpdatetoursRequest $request)
    {
        $validated = $request->validated();

        $tour = new Tours();
        $tour->name = $validated['name'];
        $tour->profile_tour = $validated['profile_tour'];
        $tour->description = $validated['description'];
        $tour->history = $validated['history'];
        $tour->fasilitas_km = $validated['fasilitas_km'];
        $tour->fasilitas_tm = $validated['fasilitas_tm'];
        $tour->fasilitas_ti = $validated['fasilitas_ti'];
        $tour->maps = $validated['maps'];
        $tour->type = $validated['type'];
        $tour->harga_tiket = $validated['harga_tiket'];

        if ($request->hasFile('profile_tour')) {
            $filename = Str::random(40) . '.' . $request->file('profile_tour')->getClientOriginalExtension();
            $request->file('profile_tour')->storeAs('wisata_images', $filename, 'public');
            $tour->profile_tour = 'wisata_images/' . $filename;
        }

        if ($tour->save()) {
            return redirect()->route('menu-wisata.index')->with('success', 'Data wisata berhasil disimpan.');
        } else {
            return redirect()->route('menu-wisata.index')->with('error', 'Gagal menyimpan data wisata. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $tour = Tours::findOrFail($id);
        return view('menu.menu-wisata.edit', compact('tour'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'history',
            'fasilitas_km' => 'required',
            'fasilitas_tm' => 'required',
            'fasilitas_ti' => 'required',
            'maps' => 'required',
            'type' => 'required',
            'harga_tiket',
        ]);

        $tour = Tours::findOrFail($id);
        $tour->name = $request->name;
        $tour->description = $request->description;
        $tour->history = $request->history;
        $tour->fasilitas_km = $request->fasilitas_km;
        $tour->fasilitas_tm = $request->fasilitas_tm;
        $tour->fasilitas_ti = $request->fasilitas_ti;
        $tour->maps = $request->maps;
        $tour->type = $request->type;
        $tour->harga_tiket = $request->harga_tiket;

        if ($request->hasFile('profile_tour')) {
            Storage::delete('public/' . $tour->profile_tour);

            $filename = Str::random(40) . '.' . $request->file('profile_tour')->getClientOriginalExtension();
            $request->file('profile_tour')->storeAs('wisata_images', $filename, 'public');
            $tour->profile_tour = 'wisata_images/' . $filename;
        }

        $tour->save();

        return redirect()->route('menu-wisata.index')->with('success', 'Data wisata berhasil diperbarui.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx',
        ]);

        Excel::import(new ToursImport, request()->file('import_file'));

        return back()->with('success', 'Tours imported successfully.');
    }

    public function destroy($id)
    {
        $tour = Tours::findOrFail($id);
        $tour->delete();

        return redirect()->route('menu-wisata.index')->with('success', 'Data wisata berhasil dihapus.');
    }
}
