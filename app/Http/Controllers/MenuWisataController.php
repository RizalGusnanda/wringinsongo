<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatetoursRequest;
use Illuminate\Http\Request;
use App\Models\Tours;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Imports\ToursImport;
use App\Models\Tours_subimages;
use App\Models\Tours_virtual;
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

        $tour->save();

        if ($request->has('additional_images')) {
            foreach ($request->file('additional_images') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('additional_images', $filename, 'public');
                Tours_subimages::create([
                    'id_tour' => $tour->id,
                    'subimages' => $path
                ]);
            }
        }

        if ($request->hasFile('virtual_tour')) {
            foreach ($request->file('virtual_tour') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('virtual_tour', $filename, 'public');

                Tours_virtual::create([
                    'id_tour' => $tour->id,
                    'virtual_tours' => $path
                ]);
            }
        }

        return redirect()->route('menu-wisata.index')->with('success', 'Data wisata berhasil disimpan.');
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
        $original = $tour->getOriginal();

        $tour->name = $request->name;
        $tour->description = $request->description;
        $tour->history = $request->history;
        $tour->fasilitas_km = $request->fasilitas_km;
        $tour->fasilitas_tm = $request->fasilitas_tm;
        $tour->fasilitas_ti = $request->fasilitas_ti;
        $tour->maps = $request->maps;
        $tour->type = $request->type;
        $tour->harga_tiket = $request->harga_tiket;

        $profileUpdated = false;
        if ($request->hasFile('profile_tour')) {
            Storage::delete('public/' . $tour->profile_tour);
            $filename = Str::random(40) . '.' . $request->file('profile_tour')->getClientOriginalExtension();
            $request->file('profile_tour')->storeAs('wisata_images', $filename, 'public');
            $tour->profile_tour = 'wisata_images/' . $filename;
            $profileUpdated = true;
        }

        $tour->save();

        $additionalImagesUpdated = false;
        if ($request->has('additional_images')) {
            foreach ($request->file('additional_images') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('additional_images', $filename, 'public');
                Tours_subimages::create([
                    'id_tour' => $tour->id,
                    'subimages' => $path
                ]);
                $additionalImagesUpdated = true;
            }
        }

        $virtualToursUpdated = false;
        if ($request->has('virtual_tour')) {
            foreach ($request->file('virtual_tour') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('virtual_tour', $filename, 'public');
                Tours_virtual::create([
                    'id_tour' => $tour->id,
                    'virtual_tours' => $path
                ]);
                $virtualToursUpdated = true;
            }
        }

        if (!$tour->wasChanged() && !$profileUpdated && !$additionalImagesUpdated && !$virtualToursUpdated) {
            return redirect()->route('menu-wisata.index')->with('danger', 'Tidak ada data yang diperbarui.');
        }

        return redirect()->route('menu-wisata.index')->with('success', 'Data wisata berhasil diperbarui.');
    }


    public function deleteImage(Request $request)
    {
        $image = Tours_subimages::findOrFail($request->id);
        Storage::disk('public')->delete($image->subimages);
        $image->delete();

        return response()->json(['status' => 'success', 'message' => 'Gambar berhasil dihapus.']);
    }


    public function deleteVirtualTourImage(Request $request)
    {
        $image = Tours_virtual::findOrFail($request->id);
        $filePath = $image->virtual_tours;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            $image->delete();
            return response()->json(['status' => 'success', 'message' => 'Gambar virtual tour berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gambar tidak ditemukan di storage.']);
        }
    }


    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx',
        ]);

        Excel::import(new ToursImport, request()->file('import_file'));

        return back()->with('success', 'Wisata berhasil diimpor.');
    }


    public function checkTourName(Request $request)
    {
        $tourName = $request->input('name');
        $exists = Tours::where('name', $tourName)->exists();

        return response()->json(['exists' => $exists]);
    }


    public function checkMaps(Request $request)
    {
        $exists = Tours::where('maps', $request->maps)->exists();
        return response()->json(['exists' => $exists]);
    }


    public function destroy($id)
    {
        $tour = Tours::findOrFail($id);

        Storage::delete('public/' . $tour->profile_tour);

        foreach ($tour->subimages as $subimage) {
            Storage::delete('public/' . $subimage->subimages);
            $subimage->delete();
        }

        foreach ($tour->virtualTours as $virtualTour) {
            Storage::delete('public/' . $virtualTour->virtual_tours);
            $virtualTour->delete();
        }

        $tour->delete();
        return redirect()->route('menu-wisata.index')->with('success', 'Data wisata berhasil dihapus.');
    }
}
