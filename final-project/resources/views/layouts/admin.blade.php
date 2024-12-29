<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>TropiCool Resort</title>
</head>

<body class="bg-body-secondary">
    <div class="d-flex">
        <div class="header bg-primary text-white d-flex align-items-center justify-content-between px-3 py-2">
            <button class="btn btn-white toggle-btn" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">TropiCool Resort</h5>
            <div class="dropdown">
                @if(session('employee'))
                <button class="btn btn-primary d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>{{ ucfirst(session('employee')->role) }}</span>
                    <i class="bi bi-chevron-down ms-2"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="#">
                            <span>{{ session('employee')->name }}</span>
                            <br>
                            <span class="text-secondary" style="font-size: smaller;">{{ session('employee')->email }}</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endif
            </div>
        </div>
        <div class="d-flex">
            <div class="sidebar bg-white" id="sidebar">
                <ul class="list-unstyled mt-3">
                    <div class="text-secondary title">
                        NAV TITLE
                    </div>
                    <li class="nav-item">
                        <a href="/reservations/index" class="nav-link {{ request()->is('reservations/index') ? 'active' : '' }}">
                            <i class="bi bi-calendar2-minus"></i>
                            <span class="nav-text">Reservation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/accommodation" class="nav-link {{ request()->is('accommodation') ? 'active' : '' }}">
                            <i class="bi bi-houses"></i>
                            <span class="nav-text">Accommodation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/amenities/index" class="nav-link {{ request()->is('amenities/index') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>
                            <span class="nav-text">Amenities</span>
                        </a>
                    </li>
                    @if(session('employee') && session('employee')->role === 'admin')
                    <li class="nav-item">
                        <a href="/employee" class="nav-link {{ request()->is('employee') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span class="nav-text">Employee</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/audit-logs" class="nav-link {{ request()->is('audit-logs') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text"></i>
                            <span class="nav-text">Audit Logs</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        @yield('content')
    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.querySelector('.content');

            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                content.style.marginLeft = '80px';
            } else {
                content.style.marginLeft = '250px';
            }
        });
    </script>
</body>

</html>