<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poiret+One&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2)),
            url("{{ asset('images/resort wide.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
        }

        .custom-input {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .custom-input input {
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            padding: 14px;
            font-size: 14px;
            background-color: transparent;
            width: 100%;
        }

        .custom-input input:focus {
            border: 2px solid #4285F4;
        }

        .custom-input label {
            position: absolute;
            top: 50%;
            left: 12px;
            font-size: 14px;
            color: #aaa;
            transition: all 0.3s ease;
            pointer-events: none;
            transform: translateY(-50%);
        }

        .custom-input input:focus+label,
        .custom-input input:not(:placeholder-shown)+label {
            top: -2px;
            font-size: 12px;
            color: #4285F4;
            background: #ffffff;
            padding: 0 5px;
        }

        .btn-info {
            background-color: #4285F4;
            border: none;
        }

        .btn-info:hover {
            background-color: #357ae8;
        }

        /* Flexbox to divide the screen */
        .vh-100 {
            display: flex;
            height: 100vh;
        }

        /* Left section for text */
        .left-section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            padding-left: 40px;
            color: white;
        }

        .left-section h1 {
            font-size: 5rem;
            font-family: 'Playfair Display', serif;
            letter-spacing: 3px;
            font-weight: bold;
        }

        .left-section h2 {
            font-size: 2rem;
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }

        /* Right section for login card */
        .right-section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
        }

        .card {
            width: 100%;
            max-width: 500px;
            border: none;
            border-radius: 10px;
        }

        /* Style for the SVG Logo inside the card */
        .svg-logo {
            display: block;
            margin: 0 auto 20px auto;
        }
    </style>

</head>

<body class="font-sans ">
    <section class="vh-100">
        <!-- Left Section for Text -->
        <div class="left-section">
            <div>
                <h1>TropiCool Resort</h1>
                <h2>Login</h2>
            </div>
        </div>

        <!-- Right Section for Login Card -->
        <div class="right-section">
            <div class="card shadow py-4 px-3">
                <div class="card-body p-4">
                    <!-- SVG Logo inside the card -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-sunset-fill mb-2 svg-logo" viewBox="0 0 16 16">
                        <path d="M7.646 4.854a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V1.5a.5.5 0 0 0-1 0v1.793l-.646-.647a.5.5 0 1 0-.708.708zm-5.303-.51a.5.5 0 0 1 .707 0l1.414 1.413a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .706l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM11.709 11.5a4 4 0 1 0-7.418 0H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
                    </svg>

                    <div class="text-center mb-4">
                        <h1 class="h2 fw-bold">LOGIN</h1>
                    </div>
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <!-- Email Input -->
                        @error('email')
                        <div class="alert alert-danger fw-semibold d-flex align-items-center">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            <small>{{ $message }}</small>
                        </div>
                        @enderror
                        <div class="custom-input">
                            <input type="email" name="email" id="email" required placeholder=" " value="{{ old('email') }}">
                            <label for="email">Email</label>
                        </div>

                        <div class="custom-input">
                            <input type="password" name="password" id="password" required placeholder=" ">
                            <label for="password">Password</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-between align-items-center">
                            <a href="/forgot-password" class="text-sm text-primary hover:underline">Forgot Password?</a>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md shadow-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 text-sm fw-semibold">
                                LOG IN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>