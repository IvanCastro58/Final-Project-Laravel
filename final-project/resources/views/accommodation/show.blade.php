<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->accommodation_name }} - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poiret+One&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0d5c3 10%, #f2ebc5 50%, #e5f0f7 80%, #dfe5f2 100%);
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            padding: 0;
            margin: 0;
            overflow-x: hidden;
            /* Prevent horizontal scrollbar */
        }

        /* Navbar styles */
        .navbar {
            background-color: #8b7f57;

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

        /* Content styles */
        .content {
            background-color: rgba(255, 255, 255, 0.9);
            /* Slightly opaque white background for content */
            border-radius: 0px;
            padding: 30px;
            margin-top: 56px;
            /* Adjusted to directly align with the navbar */
        }

        .img-fluid {
            max-width: 30%;
            height: auto;
            border-radius: 0;
        }

        .btn-right {
            text-align: left;
            margin-top: 20px;
        }

        /* Flexbox for content */
        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .flex-container img {
            width: 40%;
            /* Set image width to 40% */
            height: auto;
            margin-right: 30px;
        }

        .flex-container .room-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .flex-container {
                flex-direction: column;
                /* Stack the image and text vertically on smaller screens */
            }

            .flex-container img {
                width: 100%;
                /* Ensure image takes up full width on smaller screens */
                margin-right: 0;
            }
        }

        .row {
            gap: 50px;
        }

        .card {
            height: 400px;
            width: 250px;
            overflow: hidden;
            border-radius: 0;
            /* Ensure no border radius */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Consistent image styling */
        .card-img-top {
            height: 200px;
            width: 100%;
            object-fit: cover;
            border-radius: 0;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            text-align: center;
            /* Center text alignment */
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
            flex-grow: 1;
        }

        /* Consistent button placement */
        .card-body .btn {
            margin-top: auto;
            background-color: #8b7f57;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            border-radius: 0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body .btn:hover {
            background-color: #d67f16;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .card {
                height: auto;
                width: 100%;
            }
        }

        h1 {
            margin-top: 0;
            font-size: 3rem;
            font-weight: 600;
            font-family: 'Playfair Display', serif;
        }

        h2 {
            margin-top: 0;
            font-size: 2.5rem;
            font-weight: 500;
            font-family: "Poiret One", serif;
        }

        h3 {
            margin-top: 0;
            font-size: 2rem;
            font-weight: 200;
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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
                        <a class="nav-link active" href="/#rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#amenities">Amenities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/status">Reservation Status</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content position-relative">
        <!-- Back Button -->
        <div class="position-absolute top-0 end-0 mt-3 me-3">
            <a href="/#rooms" class="btn btn-secondary" style="border-radius: 0;">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <h1 class="mb-4">Room Details</h1>
        <div class="flex-container">
            <!-- Image -->
            <img src="{{ Storage::url($room->image) }}" alt="{{ $room->accommodation_name }}" class="img-fluid">

            <!-- Room Details -->
            <div class="room-details">
                <h3>{{ $room->accommodation_name }}</h3>
                <p><strong>Description:</strong> {{ $room->description }}</p>
                <p><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
                <p><strong>Price per Night:</strong> PHP {{ number_format($room->price_per_night, 2) }}</p>

                <!-- 'Book Now' button -->
                <div class="btn-right">
                    <a href="{{ url('/reserve') . '?room_id=' . $room->accommodation_id }}" class="btn" style="background-color: #8b7f57; color: white; border-radius: 0;">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add margin-top to create space between content and other rooms -->
    <h2 class="otherRoom mb-4 text-center mt-5">Other Rooms</h2>

    <div class="row d-flex justify-content-center">
        @foreach ($accommodations as $accommodation)
        <div class="col-md-2 col-sm-4 col-6 mb-4">
            <div class="card">
                <!-- Image with fixed aspect ratio -->
                <img
                    src="{{ Storage::url($accommodation->image) }}"
                    alt="{{ $accommodation->accommodation_name }}"
                    class="card-img-top"
                    style="height: 200px; width: 100%; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $accommodation->accommodation_name }}</h5>
                    <p class="card-text" style="flex-grow: 1;">{{ Str::limit($accommodation->description, 100) }}</p>
                    <a href="{{ route('accommodation.show', ['accommodation_id' => $accommodation->accommodation_id]) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>