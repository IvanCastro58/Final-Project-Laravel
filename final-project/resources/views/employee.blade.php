@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5 flex-grow-1 p-5 content">
        <h2 class="fw-bold">Manage Employee</h2>
        <p class="text-secondary fw-semibold">Here’s where you manage the content for accommodations.</p>
        <div class="d-flex justify-content-between align-items-center my-3">
            <a href="/accommodation/create" class="btn btn-info text-white fw-semibold rounded-pill"><i class="bi bi-plus-circle me-2"></i>Add New Accommodation</a>
            <form action="/accommodation" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control rounded-pill me-2 py-2 border-primary" placeholder="Search..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="bg-white p-4 wrapper-table mt-4">
            <h5 class="fw-bold" style="color: #3B83FB;">Accommodation Table</h5>
            <table class="table table-white mt-3 px-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Accommodation Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Capacity</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accommodations as $accommodation)
                        <tr>
                            <td>{{ $accommodation->id }}</td>
                            <td>{{ $accommodation->accommodation_name }}</td>
                            <td>
                                @if ($accommodation->image)
                                    <img src="{{ asset('storage/' . $accommodation->image) }}" alt="Accommodation Image" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $accommodation->description }}</td>
                            <td>{{ $accommodation->capacity }}</td>
                            <td>₱ {{ $accommodation->price_per_night }}</td>
                            <td>
                                @if ($accommodation->availability_status == 1)
                                    <div class="alert alert-success d-inline-flex align-items-center justify-content-center py-1 px-2" style="font-size: 12px;" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        Available
                                    </div>
                                @else
                                    <div class="alert alert-danger d-inline-flex align-items-center justify-content-center py-1 px-2" style="font-size: 12px;" role="alert">
                                        <i class="bi bi-x-circle-fill me-2"></i>
                                        Not Available
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <a href="/accommodation/{{ $accommodation->id }}/edit" class="btn btn-info text-white btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="/accommodation/{{ $accommodation->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-white btn-sm" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No accommodations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $accommodations->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
