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