<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function display()
    {
        $accommodations = Accommodation::all();
        return view('accommodation', ["accommodations" => $accommodations]);
    }

    public function create()
    {
        return view('create_accommodation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'accommodation_name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer',
            'price_per_night' => 'required|numeric',
            'availability_status' => 'required|boolean',
        ]);

        Accommodation::create($request->all());
        return redirect('/accommodation')->with('success', 'Accommodation added successfully.');
    }

    public function edit($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        return view('edit_accommodation', compact('accommodation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'accommodation_name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer',
            'price_per_night' => 'required|numeric',
            'availability_status' => 'required|boolean',
        ]);

        $accommodation = Accommodation::findOrFail($id);
        $accommodation->update($request->all());
        return redirect('/accommodation')->with('success', 'Accommodation updated successfully.');
    }

    public function destroy($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $accommodation->delete();
        return redirect('/accommodation')->with('success', 'Accommodation deleted successfully.');
    }
}

