<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Reservation;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function showReservationForm()
    {
        // Fetch accommodations with availability_status set to 1
        $accommodations = Accommodation::where('availability_status', 1)->get();
        $amenities = Amenity::all();  // Get all available amenities
        return view('reserve', compact('accommodations', 'amenities'));
    }

    public function submitReservation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'room' => [
                'required',
                function ($attribute, $value, $fail) {
                    $accommodation = DB::table('accommodations')
                        ->select('accommodation_name', 'price_per_night')
                        ->where('accommodation_name', $value)
                        ->first();
    
                    if (!$accommodation) {
                        $fail('The selected room is invalid.');
                    }
                }
            ],
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,amenity_id',
        ]);
    
        $accommodation = Accommodation::where('accommodation_name', $validated['room'])->first();
    
        if (!$accommodation || $accommodation->price_per_night === null) {
            return redirect()->back()->withErrors(['room' => 'Accommodation price is not set.']);
        }
    
        $checkIn = new \DateTime($validated['check_in']);
        $checkOut = new \DateTime($validated['check_out']);
        $nights = $checkOut->diff($checkIn)->days;
    
        $totalPrice = $nights * $accommodation->price_per_night;
    
        $amenityDetails = [];
        if (!empty($validated['amenities'])) {
            foreach ($validated['amenities'] as $amenityId) {
                $amenity = Amenity::find($amenityId);
                if ($amenity) {
                    $amenityDetails[] = [
                        'id' => $amenity->amenity_id,
                        'name' => $amenity->amenity_name,
                        'price' => $amenity->price_per_use,
                    ];
                    $totalPrice += $amenity->price_per_use;
                }
            }
        }
    
        if (!$totalPrice || $totalPrice <= 0) {
            return redirect()->back()->withErrors(['total_price' => 'Total price calculation failed.']);
        }
    
        $reservation = Reservation::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'room' => $accommodation->accommodation_name,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'amenities' => json_encode($amenityDetails),
        ]);
    
        return redirect()->route('reservation.receipt', ['reservation' => $reservation->id]);
    }
    

    public function store(Request $request)
{
    // Validation and saving logic here
    $reservation = new Reservation();
    $reservation->name = $request->name;
    $reservation->email = $request->email;
    $reservation->phone = $request->phone;
    $reservation->room = $request->room;
    $reservation->check_in = $request->check_in;
    $reservation->check_out = $request->check_out;
    $reservation->total_price =$request->totalPrice;
    $reservation->guests = $request->guests;
    $reservation->amenities = json_encode($request->amenities); // or however you want to store amenities
    $reservation->save();

    // Redirect to the confirmation page with the reservation data
    return redirect()->route('reservation.confirmation', ['id' => $reservation->id]);
}


    public function showReceipt(Reservation $reservation)
{
    return view('receipt', compact('reservation'));
}

}
