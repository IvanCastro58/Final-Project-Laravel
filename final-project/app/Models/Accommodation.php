<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $primaryKey = 'accommodation_id'; // Set the correct primary key
    public $incrementing = true;               // Ensure auto-increment is still working
    protected $keyType = 'int';                // Define the key type as integer

    protected $fillable = [
        'accommodation_name',
        'description',
        'capacity',
        'price_per_night',
        'availability_status',
        'image',
    ];

    // Other methods...
}
