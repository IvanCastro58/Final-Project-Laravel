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
    ];

    // The room is no longer a relationship, just a string
    // But you can still use the 'amenities' column as a JSON column
    protected $casts = [
        'amenities' => 'array',  // Automatically cast the amenities column to an array
    ];
}
