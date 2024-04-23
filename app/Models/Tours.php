<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_type', 'profile_tour', 'name', 'description', 'longitud', 'latitud',
        'history', 'maps', 'fasilitas_km', 'fasilitas_tm', 'fasilitas_ti', 'type',
        'harga_tiket', 'virtual_tour', 'id_testimonis'
    ];

    public function subimages()
    {
        return $this->hasMany(Tours_subimages::class, 'id_tour');
    }

}
