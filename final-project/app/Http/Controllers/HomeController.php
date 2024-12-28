<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Models\Reservation;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $accommodations = Accommodation::all();
        $amenities = Amenity::all(); 
        return view('welcome', compact('accommodations', 'amenities')); // Pass both arrays to the view
    }

    public function showStatusPage(Request $request)
    {
        $reservation = null;

        if ($request->has('reservation_id')) {
            $reservation = Reservation::where('reservation_id', $request->input('reservation_id'))->first();
        }

        return view('status', compact('reservation'));
    }
}
