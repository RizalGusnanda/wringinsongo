<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = ['id_ticket', 'id_tour', 'total_price', 'status', 'status_confirm', 'order_id'];

    public function payments()
    {
        return $this->hasOne(Payments::class, 'cart_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tours::class, 'id_tour');
    }

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'id_ticket');
    }

    public function testimonis()
    {
        return $this->hasMany(Testimonis::class, 'id_cart');
    }
}