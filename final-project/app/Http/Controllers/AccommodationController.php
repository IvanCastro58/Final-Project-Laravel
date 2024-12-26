<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AuditLog;
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

        $accommodation = Accommodation::create($data);

        $employeeId = session('employee')['id'];

        AuditLog::create([
            'action' => 'Create',
            'description' => "Accommodation with ID {$accommodation->id} added successfully.",
            'performed_by' => $employeeId,
        ]);

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

        $employeeId = session('employee')['id'];

        AuditLog::create([
            'action' => 'Update',
            'description' => "Accommodation with ID {$accommodation->id} updated successfully.",
            'performed_by' => $employeeId,
        ]);

        return redirect('/accommodation')->with('success', 'Accommodation updated successfully.');
    }

    public function destroy($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $accommodationId = $accommodation->id;
        $accommodation->delete();

        $employeeId = session('employee')['id'];

        AuditLog::create([
            'action' => 'Delete',
            'description' => "Accommodation with ID {$accommodationId} deleted successfully.",
            'performed_by' => $employeeId,
        ]);

        return redirect('/accommodation')->with('success', 'Accommodation deleted successfully.');
    }
    public function index() {
        $accommodations = Accommodation::all(); // Fetch data from the database
        return view('home', compact('accommodations'));
    }
    
}
