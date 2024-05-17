<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours_virtual extends Model
{
    use HasFactory;
    protected $fillable = ['id_tour', 'virtual_tours'];
}