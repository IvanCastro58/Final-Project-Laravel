<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->accommodation_name }} - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #FDE5BA 10%, #FCCB1B 50%, #C3D8DA 80%, #E1E7E8 100%);
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            padding: 0;
            margin: 0;
        }

        /* Navbar styles */
        .navbar {
            background-color: #C68300; /* Set background color to #C68300 */
        }

        .navbar-nav .nav-link {
            transition: all 0.3s ease;
            color: #fff; /* White text color by default */
        }

        .navbar-nav .nav-link:hover {
            color: #BFDB8B; /* Darken color on hover */
            text-decoration: none; /* Removes the underline */
        }

        /* Content styles */
        .content {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly opaque white background for content */
            border-radius: 0px;
            padding: 30px;
            margin-top: 56px; /* Adjusted to directly align with the navbar */
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
            width: 40%;  /* Set image width to 40% */
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
                flex-direction: column; /* Stack the image and text vertically on smaller screens */
            }

            .flex-container img {
                width: 100%;  /* Ensure image takes up full width on smaller screens */
                margin-right: 0;
            }
        }
        .card {
            height: 400px; /* Fixed height for uniform cards */
            width: 250px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Ensures space is used between title, text, and button */
        }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Going Resort</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#explore">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#facilities">Amenities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#contact">Reservation Status</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="content">
    <h1 class="mb-4">Room Details</h1>
    <div class="flex-container">
        <!-- Image -->
        <img src="{{ Storage::url($room->image) }}" alt="{{ $room->accommodation_name }}" class="img-fluid">

        <!-- Room Details -->
        <div class="room-details">
            <h2>{{ $room->accommodation_name }}</h2>
            <p><strong>Description:</strong> {{ $room->description }}</p>
            <p><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
            <p><strong>Price per Night:</strong> PHP {{ number_format($room->price_per_night, 2) }}</p>

            <!-- 'Book Now' button -->
            <div class="btn-right">
                <a href="/reserve" class="btn" style="background-color: #F4961A; color: white;">Book Now</a>
            </div>
        </div>
    </div>
</div>

<!-- Add margin-top to create space between content and other rooms -->
<h2 class="mb-4 text-center mt-5">Other Rooms</h2>

<div class="row d-flex justify-content-center">
    @foreach ($accommodations as $accommodation)
        <div class="col-md-2 col-sm-4 col-6 mb-4">
            <div class="card">
                <img src="{{ Storage::url($accommodation->image) }}" alt="{{ $accommodation->accommodation_name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
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
