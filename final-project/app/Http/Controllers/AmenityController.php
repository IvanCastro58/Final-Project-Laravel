<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmenityController extends Controller
{
    public function index(Request $request)
    {
        if (!session('employee')) {
            return redirect()->route('login');
        }

        $search = $request->query('search');
        $amenities = Amenity::query()
            ->when($search, function ($query, $search) {
                $query->where('amenity_name', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('amenities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amenity_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_use' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('amenities', 'public');
            $data['image'] = $imagePath;
        }

        $amenity = Amenity::create($data);

        $employeeId = session('employee')['id'];
        AuditLog::create([
            'action' => 'Create',
            'description' => "Amenity with ID {$amenity->amenity_id} added successfully.",
            'performed_by' => $employeeId,
        ]);

        return redirect()->route('amenities.index')->with('success', 'Amenity created successfully.');
    }

    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('amenities.edit', compact('amenity'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amenity_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_use' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $amenity = Amenity::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($amenity->image && Storage::exists('public/' . $amenity->image)) {
                Storage::delete('public/' . $amenity->image);
            }
            $data['image'] = $request->file('image')->store('amenities', 'public');
        }

        $amenity->update($data);

        $employeeId = session('employee')['id'];
        AuditLog::create([
            'action' => 'Update',
            'description' => "Amenity with ID {$amenity->amenity_id} updated successfully.",
            'performed_by' => $employeeId,
        ]);

        return redirect()->route('amenities.index')->with('success', 'Amenity updated successfully.');
    }


    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);

        $employeeId = session('employee')['id'];
        AuditLog::create([
            'action' => 'Delete',
            'description' => "Amenity with ID {$amenity->amenity_id} deleted successfully.",
            'performed_by' => $employeeId,
        ]);
        $amenity->delete();
        return redirect()->route('amenities.index')->with('success', 'Amenity deleted successfully.');
    }
}
