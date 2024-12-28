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
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'room' => 'required|exists:accommodations,accommodation_name',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenity,amenity_id',
        ]);
    
        // Find the selected accommodation
        $accommodation = Accommodation::where('accommodation_name', $validated['room'])->firstOrFail();
    
        // Calculate the total price (you can modify this logic as needed)
        $totalPrice = $accommodation->price_per_night * (strtotime($validated['check_out']) - strtotime($validated['check_in'])) / (60 * 60 * 24);
        if ($request->has('amenities')) {
            $totalPrice += Amenity::whereIn('amenity_id', $validated['amenities'])->sum('price_per_use');
        }
    
        // Create the reservation
        $reservation = Reservation::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'room' => $accommodation->accommodation_name,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'amenities' => json_encode($validated['amenities'] ?? []),
            'total_price' => $totalPrice,  // Assuming the total price column is added
            'status' => 'processing', // Set the default status
        ]);
    
        // Redirect to the receipt page after reservation is created
        return redirect()->route('reservation.receipt', ['id' => $reservation->id]);
    }
    public function showReceipt($id)
{
    // Retrieve the reservation using the ID
    $reservation = Reservation::findOrFail($id);

    // Pass the reservation to the view
    return view('receipt', compact('reservation'));
}
}