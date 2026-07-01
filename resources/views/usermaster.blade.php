<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/4.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel="stylesheet" href="{{ asset('css/userevents.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bookinghistory.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar">
    <div class="navbar__left">
        <a href="{{ route('home.index') }}" class="navbar__brand">EVENCIA</a>
    </div>

    <div class="navbar__nav">
        <a href="{{ route('home.index') }}">Home</a>
        <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'active' : '' }}">Events</a>
        <a href="{{ route('bookings.history') }}" class="{{ request()->routeIs('schedule.*') ? 'active' : '' }}">Booking History</a>
    </div>

    <div class="navbar__actions">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-label="Search">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>

        @auth
        @php
            $parts = explode(' ', Auth::user()->name);
            $initials = strtoupper(substr($parts[0],0,1).(isset($parts[1]) ? substr($parts[1],0,1) : ''));
        @endphp
        <div class="dropdown">
            <button class="navbar__avatar border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>