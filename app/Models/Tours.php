<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_type', 'profile_tour', 'name', 'description', 'history', 'maps', 'fasilitas_km', 'fasilitas_tm', 'fasilitas_ti', 'type',
        'harga_tiket'
    ];

    public function subimages()
    {
        return $this->hasMany(Tours_subimages::class, 'id_tour');
    }

    public function virtualTours()
    {
        return $this->hasMany(Tours_virtual::class, 'id_tour');
    }

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'id_tours');
    }

    public function carts()
    {
        return $this->hasMany(Carts::class, 'id_tour');
    }

    public function testimonis()
    {
        return $this->hasMany(Testimonis::class, 'id_tour');
    }
}
