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
        DB::table('tours')->insert([
            'name' => 'wisata wringinsongo',
            'description' => 'ini adalah deskripsi wisata',
            'history' => 'ini sejarah wisata',
            'maps' => 'https://maps.app.goo.gl/WeW2Qrm6esgRBCfe6',
            'fasilitas_km' => 'Fasilitas Tersedia',
            'fasilitas_tm' => 'Fasilitas Tersedia',
            'fasilitas_ti' => 'Fasilitas Tersedia',
            'type' => 'wisata bertiket',
            'harga_tiket' => '10000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
