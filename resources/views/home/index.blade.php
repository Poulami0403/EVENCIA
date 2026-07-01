<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENCIA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
   
</head>
<body>

{{-- ══════════════════════════════ NAVBAR ══════════════════════════════ --}}
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

{{-- ══════════════════════════════ HERO ══════════════════════════════ --}}
<section class="hero">
    <div class="hero__rays" aria-hidden="true"></div>
    <div class="hero__content">
        <h1 class="hero__title">Experience <span>Events</span><br>Reimagined with<br>Precision.</h1>
        <p class="hero__subtitle">Lumina brings clarity to the chaos of event management. Explore high-profile conferences, artistic showcases, and executive summits tailored for the modern professional.</p>
        <div class="hero__cta">
            <a href="{{ route('events.index') }}" class="btn-primary">
                Browse Events
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="" class="btn-outline">Host a Show</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════ EXPLORE CATEGORIES ══════════════════════════════ --}}
<section class="section">
    <div class="section__header">
        <div>
            <h2 class="section__title">Explore Categories</h2>
            <p class="section__subtitle">Find the perfect atmosphere for your next engagement.</p>
        </div>
        <a href="#" class="section__viewall">View All</a>
    </div>

    <div class="categories-grid categories-grid--wide">
        <div class="category-card">
            <div class="category-card__overlay"></div>
            <span class="category-card__label">Concerts</span>
            <img src="{{ asset('image/images.jfif') }}" alt="Concerts" >
        </div>
        <div class="category-card">
            <div class="category-card__overlay"></div>
            <span class="category-card__label">Sports</span>
            <img src="{{ asset('image/sports.jfif') }}" alt="Sports" >
        </div>
        <div class="category-card">
            <div class="category-card__overlay"></div>
            <span class="category-card__label">Movies</span>
            <img src="{{ asset('image/movie.jfif') }}" alt="Movies" >
        </div>
    </div>
</section>

{{-- ══════════════════════════════ RECOMMENDED CONCERTS ══════════════════════════════ --}}
<section class="section pt-0">
    <div class="section__header">
        <div>
            <h2 class="section__title">Recommended Concerts</h2>
            <p class="section__subtitle">Handpicked live performances and experiences happening near you.</p>
        </div>
        <a href="#" class="section__viewall">View All</a>
    </div>
    <div class="rec-track">
         @foreach($concerts as $show)
<a href="{{ route('events.details', $show->id) }}"
   class="media-card text-decoration-none">

    <div class="media-card__img-box">
        <img src="{{ asset('uploads/'.$show->event->image) }}"
             alt="{{ $show->event->event_name }}">

        <div class="media-card__meta">
            {{ $show->show_date }}
        </div>
    </div>

    <div class="media-card__title">
        {{ $show->event->event_name }}
    </div>

    <div class="media-card__subtitle">
        {{ $show->venue->venue_name }}
    </div>

</a>
@endforeach
    </div>
</section>

{{-- ══════════════════════════════ RECOMMENDED MOVIES ══════════════════════════════ --}}
<section class="section pt-0">
    <div class="section__header">
        <div>
            <h2 class="section__title">Recommended Movies</h2>
            <p class="section__subtitle">Top choices trending in cinemas and streaming premieres right now.</p>
        </div>
        <a href="#" class="section__viewall">View All</a>
    </div>
    <div class="rec-track">
         @foreach($movies as $show)

         <a href="{{ route('events.details', $show->id) }}"
         class="media-card text-decoration-none">
            <div class="media-card">

                <div class="media-card__img-box">
                    <img src="{{ asset('uploads/'.$show->event->image) }}"
                         alt="{{ $show->event->event_name }}">

                    <div class="media-card__meta">
                        {{ $show->show_date }}
                    </div>
                </div>

                <div class="media-card__title">
                    {{ $show->event->event_name }}
                </div>

                <div class="media-card__subtitle">
                    {{ $show->venue->venue_name }}
                </div>

            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- ══════════════════════════════ FEATURED SHOWS ══════════════════════════════ --}}
<section class="shows-section">
    <h2 class="section__title">Featured Upcoming Shows</h2>

    <div class="shows-grid">
        @forelse($featuredShows as $show)
            <div class="show-card">
                <div class="show-card__image">
                @forelse($events as $event)
                    <img src="{{ asset('uploads/'.$show->event->image) }}" alt="{{ $event->event_name }}">
                @empty
                @endforelse
                    <span class="show-card__date">
                        {{ \Carbon\Carbon::parse($show->show_date)->format('d M Y') }}
                    </span>
                </div>

                <div class="show-card__body">
                    <div class="show-card__tags">
                        <span class="tag tag--conference">Live Event</span>
                    </div>

                    <h3 class="show-card__title">{{ $show->event->event_name }}</h3>
                    <p class="show-card__location">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        {{ $show->venue->venue_name }}
                    </p>

                    <div class="show-card__footer">
                        <span class="show-card__price">{{ $show->ticket_price }}</span>
                        <a href="{{ route('bookings.layout',$show->id) }}" class="btn-ticket">Get Tickets</a>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align:center;">No Shows Available</p>
        @endforelse
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>