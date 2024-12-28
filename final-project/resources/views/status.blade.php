<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Going Resort - Reservation Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> 
    <style>
    html {
        scroll-behavior: smooth;
    }

    body {
        background: linear-gradient(to right, #FDE5BA 10%, #FCCB1B 50%, #C3D8DA 80%, #E1E7E8 100%);
        min-height: 100vh;
        font-family: 'Montserrat', sans-serif;
    }
.navbar {
    background-color: #C68300; 
}
.navbar-nav .nav-link {
    transition: all 0.3s ease;
    color: #fff; 
    padding: 5px 10px;
    position: relative; 
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
}
.navbar-nav .nav-link span {
    position: relative;
    z-index: 1;
}
.navbar-nav .nav-link:hover {
    color: #BFDB8B;
    text-decoration: none; 
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); 
}
.navbar-nav .nav-link:hover::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.navbar-nav .nav-link.active {
    color: #F8E984; 
}
    .card {
        width: 100%;
        max-width: 450px;
        margin: 0 auto;
        height: 450px;
        border: 4px solid #FCCB1B;
        transition: border 0.3s ease;
    }

    .card:hover {
        border: 4px solid #59BEEB;
    }

    .card-img-top {
        height: 200px;
        border-radius: 0px;
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
        background-color: transparent;
        border: 2px solid white;
        color: white;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 0;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }

    .btn-hero:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border-color: white;
        text-decoration: none;
    }
    .card-deck-container {
        position: relative;
    }

    .card-deck {
        display: flex;
        overflow: hidden;
        width: 100%;
        gap: 30px;
    }

    .card {
        flex: 0 0 30%;
        height: 100%;
    }
    .carousel-button {
        color: #F4961A;
        font-size: 30px;
        cursor: pointer;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        background-color: transparent;
        border: none;
    }
    .carousel-button.prev {
        left: -50px;
    }
    .carousel-button.next {
        right: -50px;
    }

    .carousel-button:hover {
        color: #59BEEB;
    }
    .short-bar {
        width: 50px;
        height: 5px;
        background-color: #BFDB8B;
        margin: 10px auto;
    }
    section h2 {
        margin-top: 0;
    }
</style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Going Resort</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/"><span>Home</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/#rooms"><span>Rooms</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/#amenities"><span>Amenities</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/status"><span>Reservation Status</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h1 class="text-center mb-4">Track Your Reservation Status</h1>
        <form action="{{ route('status') }}" method="GET" class="mb-4">
            <div class="mb-3">
                <label for="reservation_id" class="form-label">Reservation ID</label>
                <input type="text" name="reservation_id" id="reservation_id" class="form-control" placeholder="Enter your Reservation ID" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Status</button>
        </form>

        @if($reservation)
            <div class="card">
                <div class="card-header bg-success text-white">
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
                        <span 
                            class="badge 
                            {{ $reservation->status === 'cancelled' ? 'bg-danger' : '' }} 
                            {{ $reservation->status === 'approved' ? 'bg-success' : '' }} 
                            {{ $reservation->status === 'processing' ? 'bg-primary' : '' }}"
                            style="text-transform: capitalize;">
                            {{ $reservation->status }}
                        </span>
                    </p>
                </div>
            </div>
        @elseif(request()->has('reservation_id'))
            <div class="alert alert-danger">No reservation found with the provided Reservation ID.</div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
