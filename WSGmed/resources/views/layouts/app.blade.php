<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Kliniki</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Twój custom CSS -->
    <link href="{{ asset('css/hospital.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    @if (Auth::check())
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="text-center py-4">
                <a href="/home" style="padding: 0px">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="100">
                </a>
            </div>
            <a href="/home">Dashboard</a>
            <a href="/patients">Pacjenci</a>
            <a href="/medications">Leki</a>
            <a href="/locations">Sale</a>
            <a href="{{route("staff.index")}}">Personel</a>
            <a href="{{route("emergency_calls.index")}}">Emergency Calle</a>
            <a href="{{route("profile.show")}}">Profil</a>
            <form id="logout-form" action="{{ url('logout') }}" method="POST">
                {{ csrf_field() }}
                <input type="submit" value="Wyloguj" class="btn btn-danger w-100 mt-3">
            </form>
        </nav>
    @endif
    <!-- Main content -->
    <div class="flex-grow-1">
        <!-- Top navbar -->
        <nav class="navbar">
            <div class="container-fluid">
                {{--<button class="btn btn-outline-secondary" id="sidebarToggle">☰</button>--}}
                <span class="navbar-brand mb-0 h1 ms-auto">WSGMed</span>
            </div>
        </nav>

        <!-- Page content -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS & Popper CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Twój custom JS -->
<script src="{{ asset('js/hospital.js') }}"></script>
</body>
</html>
