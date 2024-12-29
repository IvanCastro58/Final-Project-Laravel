<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Going Resort - Reservation Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poiret+One&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2)),
            url("{{ asset('images/resort wide.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            background-color: #8b7f57;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-nav .nav-link {
            position: relative;
            color: #fff;
            padding: 5px 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-decoration: none;
        }

        .navbar-nav .nav-link span {
            position: relative;
            z-index: 1;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #BFDB8B;
            /* Color of the underline */
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        /* This is to handle the hover effect */
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #BFDB8B;
            text-decoration: none;
        }

        .navbar-nav .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* Update to make the active state work only on hover */
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #FCCB1B;

        }

        .btn-hero {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translateX(-50%);
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 25px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-hero:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #F1D366;
            border-color: #F1D366;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container h1 {
            font-size: 2.5rem;
            color: #6A4C1C;
            font-family: 'Playfair Display', serif;
        }

        .form-container input,
        .form-container button {
            border-radius: 30px;
            padding: 15px;
            margin-top: 20px;
            width: 100%;
            font-size: 1.1rem;
            border: 2px solid #D0B37E;
        }

        .form-container input:focus,
        .form-container button:focus {
            outline: none;
            border-color: #F1D366;
        }

        .card {
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #D0B37E;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #6A4C1C;
            color: white;
            font-size: 1.5rem;
            padding: 15px;
            font-family: 'Playfair Display', serif;
        }

        .card-body {
            padding: 25px;
            font-size: 1.1rem;
            color: #444;
        }

        .status-badge {
            padding: 8px 15px;
            border-radius: 25px;
            text-transform: capitalize;
        }

        .bg-processed {
            background-color: #F1D366;
            color: #6A4C1C;
        }

        .bg-approved {
            background-color: #4CAF50;
            color: white;
        }

        .bg-cancelled {
            background-color: #F44336;
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">TropiCool Resort</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#roomsw">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#amenities">Amenities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/status">Reservation Status</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <!-- Tracker Search on the Left -->
            <div class="col-md-5">
                <div class="form-container">
                    <h1>Track Your Reservation Status</h1>
                    <form action="{{ route('status') }}" method="GET">
                        <input type="text" name="reservation_id" id="reservation_id" class="form-control" placeholder="Enter your Reservation ID" required>
                        <button type="submit" class="btn btn-primary">Check Status</button>
                    </form>
                </div>
            </div>

            <!-- Reservation Details on the Right -->
            <div class="col-md-7">
                @if($reservation)
                <div class="card">
                    <div class="card-header">
                        Reservation Details
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $reservation->name }}</p>
                        <p><strong>Email:</strong> {{ $reservation->email }}</p>
                        <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                        <p><strong>Room:</strong> {{ $reservation->room }}</p>
                        <p><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
                        <p><strong>Check-out:</strong> {{ $reservation->check_out }}</p>
                        <p><strong>Guests:</strong> {{ $reservation->guests }}</p>
                        <p><strong>Total Price:</strong> {{ $reservation->total_price }}</p>
                        <p><strong>Status:</strong>
                            <span class="status-badge 
                                {{ $reservation->status === 'cancelled' ? 'bg-cancelled' : '' }}
                                {{ $reservation->status === 'approved' ? 'bg-approved' : '' }}
                                {{ $reservation->status === 'processing' ? 'bg-processed' : '' }}">
                                {{ $reservation->status }}
                            </span>
                        </p>
                    </div>
                </div>
                @elseif(request()->has('reservation_id'))
                <div class="alert alert-danger">No reservation found with the provided Reservation ID.</div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>