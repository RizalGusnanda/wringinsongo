<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{

    protected $fillable = [
        'user_id',
        'profile_image',
        'address',
        'phone_number',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
