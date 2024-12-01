@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5 flex-grow-1 p-5 content">
        <h2 class="fw-bold">Manage Accommodation</h2>
        <p class="text-secondary fw-semibold">Here’s where you manage the content for accommodations.</p>
        <a href="/accommodation/create" class="btn btn-info text-white fw-semibold my-3 rounded-pill"><i class="bi bi-plus-circle me-2"></i>Add New Accommodation</a>
        <div class="bg-white p-4 wrapper-table mt-4">
            <h5 class="ps-1 fw-bold" style="color: #3B83FB;">Accommodation Table</h5>
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Accommodation Name</th>
                        <th>Description</th>
                        <th>Capacity</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accommodations as $accommodation)
                        <tr>
                            <td>{{ $accommodation->id }}</td>
                            <td>{{ $accommodation->accommodation_name }}</td>
                            <td>{{ $accommodation->description }}</td>
                            <td>{{ $accommodation->capacity }}</td>
                            <td>₱ {{ $accommodation->price_per_night }}</td>
                            <td>
                                @if ($accommodation->availability_status == 1)
                                    <div class="alert alert-success d-inline-flex align-items-center justify-content-center p-2" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        Available
                                    </div>
                                @else
                                    <div class="alert alert-danger d-inline-flex align-items-center justify-content-center p-2" role="alert">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection