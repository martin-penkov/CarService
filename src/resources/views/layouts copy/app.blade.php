<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoСервиз - @yield('title', 'Управление на сервиз')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; font-size: 1.4rem; }
        .sidebar { min-height: calc(100vh - 56px); background: #212529; }
        .sidebar .nav-link { color: #adb5bd; padding: 0.6rem 1rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); border-radius: 6px; }
        .sidebar .nav-link i { margin-right: 8px; }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .stat-card { border-left: 4px solid; }
        .stat-card.primary { border-left-color: #0d6efd; }
        .stat-card.success { border-left-color: #198754; }
        .stat-card.warning { border-left-color: #ffc107; }
        .stat-card.info { border-left-color: #0dcaf0; }
    </style>
</head>
<body>

{{-- Навигационна лента --}}
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ url('/') }}">
        <i class="bi bi-wrench-adjustable-circle-fill text-warning"></i> АвтоСервиз
    </a>
    <div class="d-flex align-items-center gap-3">
        @auth
            <span class="text-light small"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-light">
                    <i class="bi bi-box-arrow-right"></i> Изход
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Вход</a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-warning">Регистрация</a>
        @endauth
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- Странична навигация (само за влезли) --}}
        @auth
        <div class="col-md-2 sidebar py-3 px-2">
            <nav class="nav flex-column gap-1">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Табло
                </a>
                <hr class="border-secondary my-2">
                <span class="text-muted small px-1 text-uppercase" style="font-size:0.7rem">Управление</span>
                <a href="{{ route('cars.index') }}" class="nav-link {{ request()->routeIs('cars.*') ? 'active' : '' }}">
                    <i class="bi bi-car-front-fill"></i> Коли
                </a>
                <a href="{{ route('repairs.index') }}" class="nav-link {{ request()->routeIs('repairs.*') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i> Ремонти
                </a>
                <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                    <i class="bi bi-list-check"></i> Услуги
                </a>
            </nav>
        </div>
        @endauth

        {{-- Основно съдържание --}}
        <div class="{{ Auth::check() ? 'col-md-10' : 'col-12' }} py-4 px-4">

            {{-- Съобщения за успех/грешка --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
