<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Montserrat font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url("{{ asset('images/banner.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: white;
        }

        .reservation-banner {
            height: 70px;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(198, 131, 0, 0.6);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

.logo-link {
    position: absolute;
    left: 20px;  /* Adjust left position to place logo */
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
    text-decoration: none;  /* Remove underline */
    font-weight: bold;  /* Optional: make the logo text bold */
    color: white;  /* Make the text white */
}

.reservation-banner h1 {
    margin: 0;
    font-size: 1.5rem;
    text-align: center;
}



        .reservation-form {
            position: relative;
            color: black;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
            overflow: hidden;
        }

        .reservation-form label,
        .reservation-form h2,
        .reservation-form .form-text {
            color: black;
        }

        .reservation-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #E4DCCB;
            opacity: 0.8;
            z-index: -1;
            border-radius: 10px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table th, table td {
            text-align: center;
            vertical-align: middle;
        }

        .price-card-wrapper {
            position: sticky;
            top: 10px; /* Adjust as needed */
            padding: 20px; /* Adjust padding as needed */
            border-radius: 15px; /* Matches the inner card's border-radius */
            background: rgba(255, 255, 255, 0); /* Transparent white background */
            z-index: 10; /* Ensure the card stays on top */
        }

        .price-card {
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .price-card h4 {
            color: #333;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 10px;
        }
        .sticky-top {
            position: sticky;
        }
    </style>
</head>
<body>
    <!-- Reservation Banner -->
    <div class="reservation-banner">
        <!-- Link to Homepage (used as logo, moved to the left) -->
        <a href="{{ url('/') }}" class="logo-link">Going Resort</a>
        <h1>Book Your Stay at Now!</h1>
    </div>


    <!-- Reservation Form -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Reservation Form Column -->
            <div class="col-md-8">
                <div class="reservation-form">
                    <h2 class="text-center mb-4">Reservation Details</h2>
                    <form id="reservationForm" action="{{ url('/reserve/submit') }}" method="POST">
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
                                    <option value="{{ $accommodation->accommodation_name }}" data-capacity="{{ $accommodation->capacity }}" data-price="{{ $accommodation->price_per_night }}">
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
                                            <td><input type="checkbox" name="amenities[]" value="{{ $amenity->amenity_id }}" onchange="updateTotalPrice()"></td>
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

            <!-- Price Card Column (Move to the right of the form) -->
            <div class="col-md-4">
                <div class="price-card-wrapper">
                    <div class="price-card sticky-top">
                        <h4>Total Price</h4>
                        <div id="totalPrice" class="total-price">₱0.00</div>
                    </div>
                </div>
</div>

    </div>

    <script>
    let roomPrice = 0;
    let amenitiesPricePerDay = 0;

    function updateCapacity() {
        var selectedRoom = document.getElementById("room_type").selectedOptions[0];
        var capacity = selectedRoom ? selectedRoom.getAttribute("data-capacity") : 0;
        roomPrice = selectedRoom ? parseFloat(selectedRoom.getAttribute("data-price")) : 0;
        
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

        updateTotalPrice();
    }

    function updateTotalPrice() {
        var checkInDate = document.getElementById("check_in").value;
        var checkOutDate = document.getElementById("check_out").value;

        if (!checkInDate || !checkOutDate || roomPrice === 0) return;

        var checkIn = new Date(checkInDate);
        var checkOut = new Date(checkOutDate);

        var timeDiff = checkOut - checkIn;
        var days = timeDiff / (1000 * 3600 * 24);

        if (days < 1) days = 1; // Ensure at least 1 day

        // Reset amenities price per day
        amenitiesPricePerDay = 0;

        // Calculate amenities cost per day
        var amenitiesChecked = document.querySelectorAll('input[name="amenities[]"]:checked');
        amenitiesChecked.forEach(function (checkbox) {
            var pricePerUse = parseFloat(checkbox.closest('tr').cells[1].innerText.replace('₱', '').replace(',', ''));
            amenitiesPricePerDay += pricePerUse;
        });

        // Calculate total price
        var totalRoomPrice = roomPrice * days;
        var totalAmenitiesPrice = amenitiesPricePerDay;

        var totalPrice = totalRoomPrice + totalAmenitiesPrice;

        // Display total price
        document.getElementById("totalPrice").innerText = "₱" + totalPrice.toFixed(2);
    }
    </script>

</body>
</html>
