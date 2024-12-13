@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5 flex-grow-1 p-5 content">
    <h2 class="fw-bold">Edit Amenity</h2>
    <p class="text-secondary fw-semibold mb-4">Update the details below to edit the amenity information.</p>
    <form method="POST" action="{{ route('amenities.update', $amenity->amenity_id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="amenity_name" class="form-label">Amenity Name</label>
            <input type="text" class="form-control" id="amenity_name" name="amenity_name" value="{{ $amenity->amenity_name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $amenity->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price_per_use" class="form-label">Price per Use</label>
            <input type="number" class="form-control" id="price_per_use" name="price_per_use" value="{{ $amenity->price_per_use }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($amenity->image)
            <img src="{{ asset('storage/' . $amenity->image) }}" alt="Amenity Image" class="img-thumbnail mt-2" style="max-width: 150px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Amenity</button>
    </form>
</div>
@endsection