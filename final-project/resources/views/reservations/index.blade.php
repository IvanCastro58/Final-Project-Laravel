@extends('layouts.admin')

@section('content')
<style>
    td {
        font-size: small;
    }
</style>
<div class="container-fluid mt-5 flex-grow-1 p-5 content">
    <h2 class="fw-bold">Manage Reservations</h2>
    <p class="text-secondary fw-semibold">Here’s where you manage reservations for your accommodations.</p>
    <div class="d-flex">
        <form action="{{ route('reservations.index') }}" method="GET" class="d-flex ms-auto">
            <input type="text" name="search" class="form-control rounded-pill me-2 py-2 border-primary" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="bg-white p-4 wrapper-table mt-4">
        <h5 class="fw-bold" style="color: #3B83FB;">Reservation Table</h5>
        <table class="table table-white mt-3 px-3">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Room</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Guests</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->reservation_id }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td>{{ $reservation->room }}</td>
                    <td>{{ $reservation->check_in }}</td>
                    <td>{{ $reservation->check_out }}</td>
                    <td>{{ $reservation->guests }}</td>
                    <td>₱{{ number_format($reservation->total_price, 2) }}</td>
                    <td>
                        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select" style="font-size: 14px;" onchange="this.form.submit()">
                                <option value="processing" {{ $reservation->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="approved" {{ $reservation->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">No reservations found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $reservations->links('pagination::bootstrap-4') }}
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