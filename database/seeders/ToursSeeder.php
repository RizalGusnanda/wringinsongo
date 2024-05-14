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
            'profile_tour' => 'wisata_images/mbung.jpg',
            'name' => 'Pemancingan Wringinsongo',
            'description' => 'Desa Wringinsongo sendiri dikelilingi oleh keindahan alam pegunungan, sehingga pengunjung dapat menikmati pemandangan yang memukau sambil menikmati hobi memancing mereka. Area pemancingan ini dilengkapi dengan beberapa kolam ikan yang dikelola dengan baik, di mana berbagai jenis ikan bisa ditemui, mulai dari ikan mas, mujair, nila, hingga lele. Selain memancing, pengunjung juga dapat menikmati fasilitas lain seperti area bermain anak, tempat duduk santai, dan warung yang menyediakan makanan dan minuman segar. Suasana tenang dan damai di sekitar pemancingan membuatnya menjadi tempat yang ideal untuk bersantai sambil menikmati kegiatan favorit Anda.',
            'history' => '-',
            'maps' => 'https://maps.app.goo.gl/FBEFNf2C9iybpWwe9',
            'fasilitas_km' => 'Fasilitas Tersedia',
            'fasilitas_tm' => 'Fasilitas Tidak Tersedia',
            'fasilitas_ti' => 'Fasilitas Tidak Tersedia',
            'type' => 'wisata bertiket',
            'harga_tiket' => '5000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DB::table('tours_subimages')->insert([
        //     ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-1.png'],
        //     ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-2.png'],
        //     ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-3.png'],
        //     ['id_tour' => $tourId, 'subimages' => 'wisata_images/dm-4.png'],
        // ]);
    }
}
