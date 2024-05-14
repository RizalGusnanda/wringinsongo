<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['order_id', 'amount', 'status', 'payment_type', 'raw_response_request', 'raw_response_response', 'cart_id'];
}