@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5 flex-grow-1 p-5 content">
    <h2 class="fw-bold">Add New Amenity</h2>
    <p class="text-secondary fw-semibold mb-4">Please fill out the form below to add a new amenity to the system.</p>
    <form method="POST" action="{{ route('amenities.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="amenity_name" class="form-label">Amenity Name</label>
            <input type="text" class="form-control" id="amenity_name" name="amenity_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price_per_use" class="form-label">Price per Use</label>
            <input type="number" class="form-control" id="price_per_use" name="price_per_use" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Add Amenity</button>
    </form>
</div>
@endsection