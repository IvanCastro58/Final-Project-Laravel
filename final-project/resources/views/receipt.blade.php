<!-- receipt.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Reservation Receipt</h2>
                    </div>
                    <div class="card-body">
                        <p>Name: {{ $reservation->name }}</p>
                        <p>Email: {{ $reservation->email }}</p>
                        <p>Phone: {{ $reservation->phone }}</p>
                        <p>Room: {{ $reservation->room }}</p>
                        <p>Amenities: {{ $reservation->amenities }}</P>
                        <p>Check-In Date: {{ $reservation->check_in }}</p>
                        <p>Check-Out Date: {{ $reservation->check_out }}</p>
                        <p>Number of Guests: {{ $reservation->guests }}</p>
                        <h5>Total Price: ₱{{ number_format($reservation->total_price, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-body">
                    <p>Please use the reservation ID below to track the status of your reservation. For any assistance, feel free to contact us.</p>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="d-flex align-items-center me-3">
                            <p id="reservation-id" class="text-center fs-3 mb-0 fw-bold text-primary">{{ $reservation->reservation_id }}</p>
                        </div>
                        <button onclick="copyToClipboard()" class="btn btn-outline-primary rounded-pill px-3 py-2 d-flex align-items-center">
                            <i class="bi bi-clipboard" style="font-size: 0.8rem;"></i><span class="ms-2">Copy to clipboard</span>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <a href="/" class="btn btn-primary">Go Back to Home</a>
            </div>
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
