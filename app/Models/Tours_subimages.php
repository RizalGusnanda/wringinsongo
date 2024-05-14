<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours_subimages extends Model
{
    use HasFactory;
    protected $fillable = ['id_tour', 'subimages'];
}
