<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ke tabel tours
        $tourId = DB::table('tours')->insertGetId([
            'profile_tour' => 'wisata_images/alam_sawah.jpg',
            'name' => 'Wisata Desa Wringinsongo',
            'description' => 'ini adalah deskripsi wisata',
            'history' => 'ini sejarah wisata',
            'maps' => 'https://maps.app.goo.gl/WeW2Qrm6esgRBCfe6',
            'fasilitas_km' => 'Fasilitas Tersedia',
            'fasilitas_tm' => 'Fasilitas Tersedia',
            'fasilitas_ti' => 'Fasilitas Tersedia',
            'type' => 'wisata bertiket',
            'harga_tiket' => '5000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tours_subimages')->insert([
            ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-1.png'],
            ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-2.png'],
            ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-3.png'],
            ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-4.png'],
        ]);
    }
}
