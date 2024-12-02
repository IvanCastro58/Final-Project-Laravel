<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .custom-input {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .custom-input input {
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            padding: 12px;
            font-size: 16px;
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
            font-size: 16px;
            color: #aaa;
            transition: all 0.3s ease;
            pointer-events: none;
            transform: translateY(-50%);
        }
        .custom-input input:focus + label,
        .custom-input input:not(:placeholder-shown) + label {
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
    </style>
</head>
<body>
    <section class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow pt-3 px-5 pb-5" style="max-width: 500px; width: 100%; border: none; border-radius: 20px;">
            <div class="card-body p-4">
                <div class="text-center mb-5">
                    <h1 class="h2 fw-bold">LOGIN</h1>
                    <p class="text-body-secondary fw-semibold">Please enter your login and password!</p>
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
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
