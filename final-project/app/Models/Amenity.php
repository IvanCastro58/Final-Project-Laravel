<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'amenity_name',
        'description',
        'price_per_use',
        'image',
    ];

    protected $primaryKey = 'amenity_id'; // Set the primary key
    public $incrementing = true;          // Ensure primary key is auto-incrementing if applicable
    protected $keyType = 'int';           // Define the primary key type

    protected $table = 'amenity';         // Explicitly set the table name

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_amenity')
                    ->withPivot('price_per_use')
                    ->withTimestamps();
    }
}
