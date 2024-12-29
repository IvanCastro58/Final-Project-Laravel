<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TropiCool Resort - Home</title>
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
            background: linear-gradient(to right, #e0d5c3 10%, #f2ebc5 50%, #e5f0f7 80%, #dfe5f2 100%);
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

        .card {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            height: 450px;
            transition: border 0.3s ease;
            overflow: hidden;
            background-color: #8b7f57;
        }

        .card-img-top {
            height: 200px;
            border-radius: 0px;
            object-fit: cover;
            transition: transform 0.3s ease;
            /* Add transition for zoom effect */
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
            height: 100vh;
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
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-text {
            position: relative;
            padding: 20px;
            border-radius: 10px;
            z-index: 2;
        }

        .hero-text h1 {
            font-size: 4rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
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
            background-color: #8b7f57;
            color: black;
            border-color: white;
            text-decoration: none;
        }

        .card-deck-container {
            position: relative;
            display: flex;
            justify-content: center;
            margin-top: 50px;
            /* Center the card */
        }

        .card-deck {
            display: flex;
            gap: 30px;
        }

        .card {
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-direction: row-reverse;
            height: 400px;
            border-radius: 0;
        }

        .card-img-top {
            width: 50%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 0;
        }

        .card-body {
            width: 50%;
            padding: 50px;
            height: auto;
            overflow-wrap: normal;
            align-items: center;
        }

        .card-title {
            font-size: 3rem;
            font-family: 'Playfair Display', serif;
            margin-bottom: 50px;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 50px;
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
            font-size: 2.5rem;
            font-weight: 900;
            font-family: "Poiret One", serif;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .card-deck-container2 {
            display: flex;
            justify-content: space-between;
            /* Even spacing between cards */
            flex-wrap: wrap;
            gap: 8px;
            /* Smaller gap between the cards */
            padding: 0 50px;
        }

        .card-deck2 {
            display: flex;
            gap: 8px;
            /* Smaller gap between the cards */
            flex-wrap: wrap;
            /* Ensure it wraps to the next row if there are more than 3 cards */
        }

        .amenities-card {
            position: relative;
            flex: 1 1 calc(28% - 8px);
            max-width: calc(28% - 8px);
            margin-bottom: 15px;
            height: 500px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .amenities-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .amenities-card .card-body {
            position: absolute;
            bottom: 0;
            width: 100%;
            color: white;
            padding: 20px;
            background: rgba(0, 0, 0, 0.6);
            opacity: 1;
            /* Always visible */
            transform: translateY(1%);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            z-index: 1;
        }

        .amenities-card:hover .card-body {
            opacity: 1;
            transform: translateY(0);
        }

        .amenities-card .card-body .amenity-name {
            display: block;
            font-size: 1.5rem;
            font-weight: 300;
            text-align: center;
            color: white;
            font-family: 'Playfair Display', serif;
            letter-spacing: 2px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
            margin-bottom: 0;
            opacity: 1;
            /* Ensure amenity name is visible */
            transform: translateY(0);
            /* Positioned at the bottom */
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .amenities-card .card-body .amenity-description {
            display: none;
            font-size: 1.1rem;
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin: 20px 0;
            opacity: 0;
            padding-top: 500px;
            transition: opacity 0.3s ease;
        }

        .amenities-card .card-body .amenity-price {
            display: none;
            font-size: 1.6rem;
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin: 20px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Keep amenity name visible at the bottom */
        .amenities-card .card-body .amenity-name {
            opacity: 1;
            /* Ensure it is always visible */
            transform: translateY(0);
            /* Keep it at the bottom of the card */
        }

        /* Hide the amenity name and show the description/price only when hovered */
        .amenities-card:hover .card-body .amenity-name {
            opacity: 0;
            transform: translateY(-20px);
            display: none;
        }

        .amenities-card:hover .card-body .amenity-description,
        .amenities-card:hover .card-body .amenity-price {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">TropiCool Resort</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" id="homeLink" href="#"><span>Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="roomsLink" href="#rooms"><span>Rooms</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="amenitiesLink" href="#amenities"><span>Amenities</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/status"><span>Reservation Status</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-text">
            <h1>Welcome to TropiCool Resort</h1>
        </div>
        <a href="/reserve" class="btn-hero">Book Now</a>
    </div>

    <!-- Featured Rooms Grid -->
    <section class="container py-5 mb-1" id="rooms">
        <div class="short-bar"></div>
        <h2 class="text-center">Rooms & Villas</h2>
        <p class="text-center">Let us give you your dream vacation. Find the perfect accommodation for your stay and select from our five villa types.</p>
        <div class="short-bar"></div>
        <div class="card-deck-container">
            <div class="card-deck" id="roomsCarousel">
                @foreach ($accommodations as $room)
                <div class="card">
                    <img src="{{ Storage::url($room->image) }}" class="card-img-top" alt="{{ $room->accommodation_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->accommodation_name }}</h5>
                        <p class="card-text">{{ $room->description }}</p>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('accommodation.show', $room->accommodation_id) }}" class="btn" style="background-color: #8b7f57; color: white; border: 1px solid white; border-radius: 0;">View Details</a>
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
    <section class="container py-5 mb-5" id="amenities">
        <div class="short-bar"></div>
        <h2 class="text-center">Our Amenities</h2>
        <div class="short-bar"></div>
        <div class="card-deck-container2">
            <div class="card-deck2">
                @foreach ($amenities as $amenity)
                <div class="card amenities-card">
                    <img src="{{ Storage::url($amenity->image) }}" class="card-img-top" alt="{{ $amenity->amenity_name }}">
                    <div class="card-body d-flex flex-column justify-content-end">
                        <p class="amenity-name text-center mb-0">{{ $amenity->amenity_name }}</p>
                        <p class="amenity-description text-center mb-0">{{ $amenity->description }}</p>
                        <p class="amenity-price text-center mb-0">₱{{ $amenity->price_per_use }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Bootstrap JS (Ensure you have this included) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        let currentIndex = 0;
        const cards = document.querySelectorAll('#roomsCarousel .card');
        const totalCards = cards.length;

        // Function to show only one card
        function showCards(startIndex) {
            cards.forEach((card, index) => {
                if (index === startIndex) {
                    card.style.display = 'flex'; // Show the current card
                } else {
                    card.style.display = 'none'; // Hide the other cards
                }
            });
        }

        // Next button click event
        document.getElementById('nextBtn').addEventListener('click', () => {
            currentIndex += 1;

            if (currentIndex >= totalCards) {
                currentIndex = 0; // Loop back to the first card
            }
            showCards(currentIndex);
        });

        // Previous button click event
        document.getElementById('prevBtn').addEventListener('click', () => {
            currentIndex -= 1;

            if (currentIndex < 0) {
                currentIndex = totalCards - 1; // Loop back to the last card
            }
            showCards(currentIndex);
        });

        // Show the first card by default
        showCards(currentIndex);

        const links = document.querySelectorAll('.nav-link');
        const homeLink = document.getElementById('homeLink');
        const roomsLink = document.getElementById('roomsLink');
        const amenitiesLink = document.getElementById('amenitiesLink');

        // Set default active to Home
        homeLink.classList.add('active');

        // Function to handle link activation based on section visibility
        function setActiveLinkOnScroll() {
            const sections = document.querySelectorAll('section');
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const scrollPosition = window.scrollY;

                // Check if the section is in the viewport
                if (scrollPosition >= sectionTop - 100 && scrollPosition < sectionTop + sectionHeight - 100) {
                    currentSection = section.getAttribute('id');
                }
            });

            // Remove active class from all links
            links.forEach(link => link.classList.remove('active'));

            // Add active class to the corresponding link based on the current section
            if (currentSection === 'rooms') {
                roomsLink.classList.add('active');
            } else if (currentSection === 'amenities') {
                amenitiesLink.classList.add('active');
            } else {
                homeLink.classList.add('active');
            }
        }

        // Listen for scroll events to update active link
        window.addEventListener('scroll', setActiveLinkOnScroll);

        // Call setActiveLinkOnScroll on page load to check the current section
        setActiveLinkOnScroll();
    </script>

</body>

</html>