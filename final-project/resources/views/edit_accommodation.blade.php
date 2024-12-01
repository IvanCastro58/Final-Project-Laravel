@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5 flex-grow-1 p-5 content">
    <h2 class="fw-bold">Edit Accommodation</h2>
    <p class="text-secondary fw-semibold mb-4">Update the details below to edit the accommodation information.</p>
    <form method="POST" action="/accommodation/{{ $accommodation->id }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="accommodation_name" class="form-label">Accommodation Name</label>
            <input type="text" class="form-control" id="accommodation_name" name="accommodation_name" value="{{ $accommodation->accommodation_name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $accommodation->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $accommodation->capacity }}" required>
        </div>
        <div class="mb-3">
            <label for="price_per_night" class="form-label">Price Per Night</label>
            <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" value="{{ $accommodation->price_per_night }}" required>
        </div>
        <div class="mb-3">
            <label for="availability_status" class="form-label">Availability</label>
            <select class="form-control" id="availability_status" name="availability_status" required>
                <option value="1" {{ $accommodation->availability_status == 1 ? 'selected' : '' }}>Available</option>
                <option value="0" {{ $accommodation->availability_status == 0 ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Accommodation</button>
    </form>
</div>
@endsection
