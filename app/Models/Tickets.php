<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = ['id_users', 'id_tours', 'date', 'tickets_count'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function tour()
    {
        return $this->belongsTo(Tours::class, 'id_tours');
    }
}
