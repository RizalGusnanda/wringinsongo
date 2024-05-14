<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => 2,
            'profile_image' => null,
            'address' => 'malang',
            'phone_number' => '081216160597',
            'gender' => 'Laki-laki',
        ]);
    }
}
