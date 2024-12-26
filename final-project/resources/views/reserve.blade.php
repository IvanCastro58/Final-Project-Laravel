<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .reservation-form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .reservation-banner {
            background-image: url("{{ asset('images/reservation-banner.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }
        .reservation-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }
        .reservation-banner h1 {
            z-index: 2;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Reservation Banner -->
    <div class="reservation-banner">
        <h1>Book Your Stay</h1>
    </div>

    <!-- Reservation Form -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="reservation-form">
                    <h2 class="text-center mb-4">Reservation Details</h2>
                    <form action="{{ route('reservation.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="room_type" class="form-label">Select Room Type</label>
                            <select name="room" class="form-control" id="room_type" onchange="updateCapacity()" required>
                                <option value="">Select Room</option>
                                @foreach ($accommodations as $accommodation)
                                    <option value="{{ $accommodation->accommodation_name }}" data-capacity="{{ $accommodation->capacity }}">
                                        {{ $accommodation->accommodation_name }} - ₱{{ number_format($accommodation->price_per_night, 2) }}
                                    </option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check-In Date</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check-Out Date</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Number of Guests</label>
                            <input type="number" class="form-control" id="guests" name="guests" placeholder="Enter number of guests" required min="1" disabled>
                            <small id="guestHelp" class="form-text text-muted">Select a room first to enable this field.</small>
                        </div>

                        <!-- Amenities Table -->
                        <div class="mb-3">
                            <label class="form-label">Select Amenities</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Amenity</th>
                                        <th scope="col">Price per Use</th>
                                        <th scope="col">Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $amenity)
                                        <tr>
                                            <td>{{ $amenity->amenity_name }}</td>
                                            <td>₱{{ number_format($amenity->price_per_use, 2) }}</td>
                                            <td><input type="checkbox" name="amenities[]" value="{{ $amenity->amenity_id }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Reserve Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateCapacity() {
            // Get selected room option
            var selectedRoom = document.getElementById("room_type").selectedOptions[0];
            var capacity = selectedRoom ? selectedRoom.getAttribute("data-capacity") : 0;

            // Enable the guest input field and set its maximum value
            var guestInput = document.getElementById("guests");
            var guestHelpText = document.getElementById("guestHelp");

            if (capacity > 0) {
                guestInput.disabled = false;
                guestInput.max = capacity;
                guestHelpText.textContent = "Maximum allowed guests: " + capacity;
            } else {
                guestInput.disabled = true;
                guestInput.value = '';
                guestHelpText.textContent = "Select a room first to enable this field.";
            }
        }
    </script>
</body>
</html>
