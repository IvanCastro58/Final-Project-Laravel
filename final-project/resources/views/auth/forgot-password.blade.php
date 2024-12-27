<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body class="font-sans">
    <section class="vh-100 d-flex flex-column justify-content-center align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-sunset-fill mb-2" viewBox="0 0 16 16">
            <path d="M7.646 4.854a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V1.5a.5.5 0 0 0-1 0v1.793l-.646-.647a.5.5 0 1 0-.708.708zm-5.303-.51a.5.5 0 0 1 .707 0l1.414 1.413a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .706l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM11.709 11.5a4 4 0 1 0-7.418 0H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
        </svg>
        <div class="card shadow py-4 px-3" style="max-width: 600px; width: 100%; border: none; border-radius: 10px;">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h1 class="h2 fw-bold mb-3">Forgot Password</h1>
                    <p class="text-muted" style="font-size: 0.9rem;">Enter your registered email address, and we'll send you a link to reset your password.</p>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
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
                    
                    <div class="flex justify-between align-items-center">
                        <a href="/login" class="text-sm text-primary hover:underline">
                            <i class="fas fa-arrow-left me-1"></i> Return to Login
                        </a>
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md shadow-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 text-sm fw-semibold">
                            Send Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
