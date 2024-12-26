<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Amenity;

class HomeController extends Controller
{
    public function showHomePage()
    {
        // Fetch all accommodations and amenities
        $accommodations = Accommodation::all();
        $amenities = Amenity::all(); // Fetch all amenities
        
        // Pass both the data to the view
        return view('welcome', compact('accommodations', 'amenities')); // Pass both arrays to the view
    }
}
