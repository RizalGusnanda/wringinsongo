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
            'name' => 'Pemancingan Wringinsongo',
            'description' => 'Kolam Sumberingin di Desa Wringinsongo adalah destinasi wisata alam yang menawarkan pengalaman berenang di kolam dengan air jernih dan segar yang berasal dari mata air alami. Terletak di tengah suasana pedesaan yang asri dan sejuk, tempat ini dilengkapi dengan fasilitas seperti area piknik, gazebo, warung makan, serta kamar mandi dan ruang ganti yang bersih. Pengunjung dapat menikmati berenang, piknik, dan relaksasi di tengah pemandangan hijau yang menenangkan. Dengan keindahan alamnya dan ketenangan yang ditawarkan, Kolam Sumberingin menjadi tempat ideal untuk liburan singkat yang menyegarkan.',
            'history' => '-',
            'maps' => 'https://maps.app.goo.gl/iJ7CTLWBEeE45UsM9',
            'fasilitas_km' => 'Fasilitas Tersedia',
            'fasilitas_tm' => 'Fasilitas Tidak Tersedia',
            'fasilitas_ti' => 'Fasilitas Tidak Tersedia',
            'type' => 'wisata bertiket',
            'harga_tiket' => '5000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
