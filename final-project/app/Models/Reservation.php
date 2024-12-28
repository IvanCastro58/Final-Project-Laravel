<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'room',
        'check_in',
        'check_out',
        'guests',
        'total_price',
        'amenities',
        'reservation_id', 
        'status',
    ];

    protected $casts = [
        'amenities' => 'array', 
    ];
}
