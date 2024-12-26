<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Registration</title>
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
            padding: 12px;
            font-size: 12px;
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
            font-size: 12px;
            color: #aaa;
            transition: all 0.3s ease;
            pointer-events: none;
            transform: translateY(-50%);
        }
        .custom-input input:focus + label,
        .custom-input input:not(:placeholder-shown) + label {
            top: -2px;
            font-size: 10px;
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
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-plus-fill mb-2" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H1zm4-3c-2.5 0-4 .943-4 2h8c0-1.057-1.5-2-4-2zM7 4a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
            <path fill-rule="evenodd" d="M13 5a.5.5 0 0 1 .5.5v2H15a.5.5 0 0 1 0 1h-1.5v2a.5.5 0 0 1-1 0V8.5H11a.5.5 0 0 1 0-1h1.5v-2A.5.5 0 0 1 13 5z"/>
        </svg>
        <div class="card shadow py-4 px-3" style="max-width: 500px; width: 100%; border: none; border-radius: 10px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h1 class="h2 fw-bold">REGISTER</h1>
                </div>
                <form method="POST" action="{{ route('registerAccount', ['token' => $token]) }}">
                    @csrf
                    
                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger fw-semibold">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><small>{{ $error }}</small></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Name Input -->
                    <div class="custom-input">
                        <input type="text" name="name" id="name" required placeholder=" " value="{{ old('name') }}">
                        <label for="name">Name</label>
                    </div>

                    <!-- Email Input (readonly since email comes from the invite) -->
                    <div class="custom-input">
                        <input type="email" name="email" id="email" placeholder=" " value="{{ $employee->email }}" readonly>
                        <label for="email">Email</label>
                    </div>

                    <!-- Password Input -->
                    <div class="custom-input">
                        <input type="password" name="password" id="password" required placeholder=" ">
                        <label for="password">Password</label>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="custom-input">
                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder=" ">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md shadow-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 text-sm fw-semibold">
                            REGISTER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
