<?php

namespace App\Imports;

use App\Models\Tours;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ToursImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $description = $row['deskripsi'];
        $history = $row['sejarah'];

        $description = nl2br($description);
        $history = nl2br($history);

        $imageName = $row['profile_tour'];

        $destinationPath = 'wisata_images/' . $imageName;
        $imagePath = '/path/to/your/image/directory/' . $imageName;

        if (file_exists($imagePath)) {
            Storage::putFileAs('public', $imagePath, $destinationPath);
        } else {
            // Tangani jika file gambar tidak ditemukan
        }

        return new Tours([
            'name' => $row['nama_wisata'],
            'description' => $description,
            'history' => $history,
            'fasilitas_km' => $row['fasilitas_kamar_mandi'],
            'fasilitas_tm' => $row['fasilitas_tempat_makan'],
            'fasilitas_ti' => $row['fasilitas_tempat_ibadah'],
            'maps' => $row['maps'],
            'type' => $row['type'],
            'harga_tiket' => $row['harga_tiket'],
            'profile_tour' => $destinationPath,
        ]);
    }
}
