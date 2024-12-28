<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Reservation;
use App\Models\Amenity;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'room' => 'required|exists:accommodations,accommodation_name',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenity,amenity_id',
        ]);

        $accommodation = Accommodation::where('accommodation_name', $validated['room'])->firstOrFail();

        $totalPrice = $accommodation->price_per_night * (strtotime($validated['check_out']) - strtotime($validated['check_in'])) / (60 * 60 * 24);

        $amenityNames = [];
        if ($request->has('amenities')) {
            $amenities = Amenity::whereIn('amenity_id', $validated['amenities'])->get();
            $amenityNames = $amenities->pluck('amenity_name')->toArray();
            $totalPrice += $amenities->sum('price_per_use');
        }

        $reservationId = 'RES-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        $reservation = Reservation::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'room' => $accommodation->accommodation_name,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'amenities' => json_encode($amenityNames),
            'total_price' => $totalPrice,
            'reservation_id' => $reservationId,
            'status' => 'processing',
        ]);

        return redirect()->route('reservation.receipt', ['id' => $reservation->id]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:processing,approved,cancelled',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $validated['status']]);

        $employeeId = session('employee')['id'];

        AuditLog::create([
            'action' => 'Update',
            'description' => "Reservation with ID {$reservation->reservation_id} status updated to " . strtoupper($validated['status']) . ".",
            'performed_by' => $employeeId,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation status updated successfully.');

        
    }

    public function showReceipt($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('receipt', compact('reservation'));
    }

    public function index()
    {
        $reservations = Reservation::paginate(10); 
        return view('reservations.index', compact('reservations'));
    }
}