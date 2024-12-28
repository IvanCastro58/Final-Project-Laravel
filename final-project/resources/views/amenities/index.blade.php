@extends('layouts.admin')

@section('content')
<style>
    td{
        font-size: small;
    }
</style>
<div class="container-fluid mt-5 flex-grow-1 p-5 content">
    <h2 class="fw-bold">Manage Amenities</h2>
    <p class="text-secondary fw-semibold">Here’s where you manage the content for amenities.</p>
    <div class="d-flex justify-content-between align-items-center my-3">
        <a href="{{ route('amenities.create') }}" class="btn btn-info text-white fw-semibold rounded-pill"><i class="bi bi-plus-circle me-2"></i>Add New Amenity</a>
        <form action="{{ route('amenities.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control rounded-pill me-2 py-2 border-primary" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="bg-white p-4 wrapper-table mt-4">
        <h5 class="fw-bold" style="color: #3B83FB;">Amenities Table</h5>
        <table class="table table-white mt-3 px-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price per Use</th>
                    <th>Image</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($amenities as $amenity)
                <tr>
                    <td>{{ $amenity->amenity_name }}</td>
                    <td>{{ $amenity->description }}</td>
                    <td>₱{{ number_format($amenity->price_per_use, 2) }}</td>
                    <td>
                        @if ($amenity->image)
                        <img src="{{ asset('storage/' . $amenity->image) }}" alt="Amenity Image" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('amenities.edit', $amenity->amenity_id) }}" class="btn btn-info text-white btn-sm rounded-pill"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('amenities.destroy', $amenity->amenity_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white btn-sm rounded-pill" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No amenities found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $amenities->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection