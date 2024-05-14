<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonis extends Model
{
    use HasFactory;
    protected $fillable = ['id_tour','id_cart', 'id_users', 'reviews', 'rating'];

    public function tour()
    {
        return $this->belongsTo(Tours::class, 'id_tour');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
