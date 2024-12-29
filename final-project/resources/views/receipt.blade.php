<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url("{{ asset('images/resort wide.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            font-family: 'Playfair Display', serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 600px;
            margin: 20px auto;
        }

        .card-header {
            background-color: #333;
            color: #fff;
            border-radius: 12px 12px 0 0;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            padding: 1rem 1.5rem;
            letter-spacing: 3px;
        }

        .card-body {
            padding: 1.5rem;
            font-size: 1rem;
            color: #555;
        }

        .card-body p {
            margin-bottom: 0.5rem;
        }

        .card-body h5 {
            color: #8b6f47;
            font-weight: bold;
        }

        #reservation-id {
            font-size: 1.3rem;
            font-weight: 600;
            color: blue;
        }

        .btn-primary {
            background-color: #6f42c1;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #5a3799;
        }

        .btn-outline-primary {
            border: 1px solid #6f42c1;
            color: #6f42c1;
            border-radius: 30px;
            padding: 0.4rem 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #6f42c1;
            color: #fff;
        }

        .btn-home {
            background-color: rgb(216, 173, 18);
            width: 50%;
            border-radius: 5px;
            border-width: 0;
            padding: 8px;
            font-size: 1rem;
            text-decoration: none;
            color: white;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .btn-primary,
            .btn-outline-primary {
                padding: 0.4rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                Reservation Receipt
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $reservation->name }}</p>
                <p><strong>Email:</strong> {{ $reservation->email }}</p>
                <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                <p><strong>Room:</strong> {{ $reservation->room }}</p>
                <p><strong>Amenities:</strong> {{ $reservation->amenities }}</p>
                <p><strong>Check-In Date:</strong> {{ $reservation->check_in }}</p>
                <p><strong>Check-Out Date:</strong> {{ $reservation->check_out }}</p>
                <p><strong>Number of Guests:</strong> {{ $reservation->guests }}</p>
                <h5>Total Price: ₱{{ number_format($reservation->total_price, 2) }}</h5>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body text-center">
                <p>Please use the reservation ID below to track your reservation status:</p>
                <p id="reservation-id">{{ $reservation->reservation_id }}</p>
                <button onclick="copyToClipboard()" class="btn btn-outline-primary">
                    <i class="bi bi-clipboard"></i> Copy to Clipboard
                </button>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/" class="btn-home">Go Back to Home</a>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const copyText = document.getElementById("reservation-id");
            navigator.clipboard.writeText(copyText.innerText).then(() => {
                alert("Reservation ID copied to clipboard!");
            });
        }
    </script>
</body>

</html>