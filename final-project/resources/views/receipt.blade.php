<!-- receipt.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Reservation Receipt</h2>
                    </div>
                    <div class="card-body">
                        <h4>Transaction ID: {{ $reservation->id }}</h4>
                        <p>Status: {{ ucfirst($reservation->status) }}</p>
                        <p>Name: {{ $reservation->name }}</p>
                        <p>Email: {{ $reservation->email }}</p>
                        <p>Phone: {{ $reservation->phone }}</p>
                        <p>Room: {{ $reservation->room }}</p>
                        <p>Check-In Date: {{ $reservation->check_in }}</p>
                        <p>Check-Out Date: {{ $reservation->check_out }}</p>
                        <p>Number of Guests: {{ $reservation->guests }}</p>
                        <h5>Total Price: ₱{{ number_format($reservation->total_price, 2) }}</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
