<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Montserrat font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poiret+One&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url("{{ asset('images/bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: white;
        }

        .reservation-banner {
            height: 65px;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #8b7f57;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        h1 {
            font-size: 1rem;
            font-family: 'Playfair Display', serif;
        }

        h2 {
            font-size: 2.5rem;
            font-family: 'Playfair Display', serif;
        }

        h4 {
            font-size: 1.5rem;
            font-family: 'Playfair Display', serif;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-reserve {
            background-color: rgb(216, 173, 18);
            width: 50%;
            border-radius: 0;
            border-width: 0;
            padding: 8px;
            font-size: 1rem;
        }

        .logo-link {
            position: absolute;
            left: 20px;
            /* Adjust left position to place logo */
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.1rem;
            text-decoration: none;
            color: white;
            font-family: 'Montserrat', sans-serif;
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
            border-radius: 0px;
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
            opacity: 0.9;
            z-index: -1;
            border-radius: 0px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table th,
        table td {
            text-align: center;
            vertical-align: middle;
        }

        .price-card-wrapper {
            position: sticky;
            top: 10px;
            /* Adjust as needed */
            padding: 0 20px 20px 20px;
            /* Adjust padding as needed */
            border-radius: 0px;
            /* Matches the inner card's border-radius */
            background: rgba(255, 255, 255, 0);
            /* Transparent white background */
            z-index: 10;
            /* Ensure the card stays on top */
        }

        .price-card {
            padding: 20px;
            border-radius: 0px;
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
<?php
$selectedRoomId = request()->query('room_id');
$selectedRoom = $accommodations->firstWhere('accommodation_id', $selectedRoomId);
?>

<body>
    <div class="reservation-banner">
        <a href="{{ url('/') }}" class="logo-link">TropiCool Resort</a>
        <h1>Book Your Stay Now!</h1>
        <a href="{{ url('/#rooms') }}" class="btn btn-secondary position-absolute top-0 end-0 mt-3 me-3" style="border-radius: 0;">
            <i class="fas fa-arrow-left"></i> Back
        </a>
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="(09123456789)" required minlength="11" maxlength="11">
                        </div>
                        <div class="form-group mb-3">
                            <label for="room_type" class="form-label">Select Room Type</label>
                            <select name="room" class="form-control" id="room_type" onchange="updateCapacity()" required>
                                <option value="">Select Room</option>
                                @foreach ($accommodations as $accommodation)
                                <option value="{{ $accommodation->accommodation_name }}"
                                    data-capacity="{{ $accommodation->capacity }}"
                                    data-price="{{ $accommodation->price_per_night }}"
                                    @if($selectedRoom && $accommodation->accommodation_id == $selectedRoom->accommodation_id) selected @endif>
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
                            <button type="submit" class="btn-reserve">Reserve Now</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Price Card Column (Move to the right of the form) -->
            <div class="col-md-4">
                <div class="price-card-wrapper">
                    <div class="price-card sticky-top">
                        <h4>Reservation Summary</h4>
                        <p><strong>Room Price:</strong> ₱<span id="roomPrice">0.00</span></p>
                        <p><strong>Amenity Price:</strong> ₱<span id="amenityPrice">0.00</span></p>
                        <hr>
                        <p class="total-price"><strong>Total Price:</strong> ₱<span id="totalPrice">0.00</span></p>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const today = new Date().toISOString().split("T")[0];
                document.getElementById("check_in").setAttribute("min", today);
            });

            let roomPrice = 0;
            let amenitiesPricePerDay = 0;

            function updateCapacity() {
                var selectedRoom = document.getElementById("room_type").selectedOptions[0];
                var capacity = selectedRoom ? selectedRoom.getAttribute("data-capacity") : 0;
                roomPrice = selectedRoom ? parseFloat(selectedRoom.getAttribute("data-price")) : 0;

                // Immediately update the total price when room is selected
                updateTotalPrice();

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

            function updateTotalPrice() {
                var checkInDate = document.getElementById("check_in").value;
                var checkOutDate = document.getElementById("check_out").value;

                let days = 1; // Default to 1 day if no dates are selected
                if (checkInDate && checkOutDate) {
                    var checkIn = new Date(checkInDate);
                    var checkOut = new Date(checkOutDate);
                    var timeDiff = checkOut - checkIn;
                    days = timeDiff / (1000 * 3600 * 24);
                    if (days < 1) days = 1; // Ensure at least 1 day
                }

                // Reset amenities price per day
                amenitiesPricePerDay = 0;

                // Calculate amenities cost per day
                var amenitiesChecked = document.querySelectorAll('input[name="amenities[]"]:checked');
                amenitiesChecked.forEach(function(checkbox) {
                    var pricePerUse = parseFloat(checkbox.closest('tr').cells[1].innerText.replace('₱', '').replace(',', ''));
                    amenitiesPricePerDay += pricePerUse;
                });

                // Calculate total price
                var totalRoomPrice = roomPrice > 0 ? roomPrice * days : 0;
                var totalAmenitiesPrice = amenitiesPricePerDay > 0 ? amenitiesPricePerDay : 0;

                var totalPrice = totalRoomPrice + totalAmenitiesPrice;

                // Display prices in summary, defaulting to 0.00 when no data
                document.getElementById("roomPrice").innerText = totalRoomPrice.toFixed(2);
                document.getElementById("amenityPrice").innerText = totalAmenitiesPrice.toFixed(2);
                document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
            }

            document.querySelectorAll('input[name="amenities[]"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            document.getElementById("check_in").addEventListener('change', function() {
                var checkInDate = new Date(document.getElementById("check_in").value);
                var checkOutInput = document.getElementById("check_out");

                checkOutInput.min = document.getElementById("check_in").value;

                if (new Date(checkOutInput.value) < checkInDate) {
                    checkOutInput.value = document.getElementById("check_in").value;
                }

                updateTotalPrice();
            });

            document.getElementById("check_out").addEventListener('change', updateTotalPrice);
            window.onload = function() {
                updateCapacity(); // Call the function to update the capacity based on the selected room
                updateTotalPrice(); // Ensure total price is updated if a room was pre-selected
            };
        </script>

</body>

</html>