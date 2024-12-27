<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resort Name - Home</title>
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
                    <a class="nav-link active" aria-current="page" href="#"><span>Home</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#explore"><span>Rooms</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#facilities"><span>Amenities</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#contact"><span>Reservation Status</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-text">
            <h1>Welcome to Going Resort</h1>
        </div>
        <a href="/reserve" class="btn-hero">Book Now</a>
    </div>

    <!-- Featured Rooms Grid -->
    <section class="container py-5 mb-5" id="explore">
        <div class="short-bar"></div>
        <h2 class="text-center">Our Rooms</h2>
        <div class="short-bar"></div>
        <div class="card-deck-container">
            <div class="card-deck" id="roomsCarousel">
                @foreach ($accommodations as $room)
                    <div class="card">
                        <img src="{{ Storage::url($room->image) }}" class="card-img-top" alt="{{ $room->accommodation_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->accommodation_name }}</h5>
                            <p class="card-text">{{ $room->description }}</p>
                            <p class="card-text"><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
                            <p class="card-text"><strong>Price per Night:</strong> PHP {{ number_format($room->price_per_night, 2) }}</p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('accommodation.show', $room->accommodation_id) }}" class="btn" style="background-color: #F4961A; color: white;">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-button prev" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
            <button class="carousel-button next" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- Amenities Grid -->
    <section class="container py-5" id="facilities">
        <div class="short-bar"></div>
        <h2 class="text-center">Our Amenities</h2>
        <div class="short-bar"></div>
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

    <script>
        let currentIndex = 0;
const cards = document.querySelectorAll('#roomsCarousel .card');
const totalCards = cards.length;
const cardsPerPage = 3;

// Function to show cards based on the current index
function showCards(startIndex) {
    cards.forEach((card, index) => {
        if (index >= startIndex && index < startIndex + cardsPerPage) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Next button click event
document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex += cardsPerPage;

    // If the currentIndex exceeds the total number of cards, loop back to the start
    if (currentIndex >= totalCards) {
        currentIndex = 0;
    }
    showCards(currentIndex);
});

// Previous button click event
document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex -= cardsPerPage;

    // If the currentIndex is below 0, loop back to the last set of cards
    if (currentIndex < 0) {
        currentIndex = totalCards - cardsPerPage;
    }
    showCards(currentIndex);
});

// Show initial cards
showCards(currentIndex);

    </script>

</body>
</html>
