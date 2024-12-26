<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resort Name - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .card {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            height: 450px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            height: calc(100% - 200px);
            overflow: hidden;
        }

        .hero-section {
            background-image: url("{{ asset('images/resort wide.jpg') }}");
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero-text {
            position: relative;
            padding: 20px;
            border-radius: 10px;
            z-index: 2;
        }

        .btn-hero {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            background-color: #ff5a5f;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 30px;
            text-decoration: none;
            text-align: center;
        }

        .btn-hero:hover {
            background-color: #ff3b45;
            text-decoration: none;
        }

        /* Grid Layout for Cards */
        .card-deck {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 30px;
        }

        .card {
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Paradise Resort</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#explore">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#facilities">Amenities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Reservation Status</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-text">
            <h1>Welcome to Paradise Resort</h1>
        </div>
        <a href="/reserve" class="btn-hero">Book Now</a>
    </div>

    <!-- Featured Rooms Grid -->
    <section class="container py-5" id="explore">
        <h2 class="text-center mb-4">Our Featured Rooms</h2>
        <div class="card-deck">
            @foreach ($accommodations as $room)
                <div class="card">
                    <img src="{{ Storage::url($room->image) }}" class="card-img-top" alt="{{ $room->accommodation_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->accommodation_name }}</h5>
                        <p class="card-text">{{ $room->description }}</p>
                        <p class="card-text"><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
                        <p class="card-text"><strong>Price per Night:</strong> PHP {{ number_format($room->price_per_night, 2) }}</p>
                        <a href="/accommodation/{{ $room->id }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Amenities Grid -->
    <section class="container py-5" id="facilities">
        <h2 class="text-center mb-4">Our Amenities</h2>
        <div class="card-deck">
            @foreach ($amenities as $amenity)
                <div class="card amenities-card">
                    <img src="{{ Storage::url($amenity->image) }}" class="card-img-top" alt="{{ $amenity->amenity_name }}">
                    <div class="card-body amenities-card-body">
                        <h5 class="card-title">{{ $amenity->amenity_name }}</h5>
                        <p class="card-text">{{ $amenity->description }}</p>
                        <p class="card-text"><strong>Price per Use:</strong> PHP {{ number_format($amenity->price_per_use, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Bootstrap JS (Ensure you have this included) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
