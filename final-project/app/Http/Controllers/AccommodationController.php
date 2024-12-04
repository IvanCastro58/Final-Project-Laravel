<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function display(Request $request)
    {
        if (!session('employee')) {
            return redirect()->route('login'); 
        }

        $search = $request->query('search');
        $accommodations = Accommodation::query()
            ->when($search, function ($query, $search) {
                $query->where('accommodation_name', 'LIKE', "%{$search}%");
            })
            ->paginate(10); 

        return view('accommodation', ["accommodations" => $accommodations]);
    }

    public function create()
    {
        if (!session('employee')) {
            return redirect()->route('login'); 
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('accommodations', 'public');
            $data['image'] = $imagePath;
        }

        Accommodation::create($data);

        return redirect('/accommodation')->with('success', 'Accommodation added successfully.');
    }


    public function edit($id)
    {
        if (!session('employee')) {
            return redirect()->route('login'); 
        }

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

