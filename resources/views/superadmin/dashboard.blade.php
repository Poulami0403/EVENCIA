<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENCIA - Super Admin Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">

</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 p-0">
            @include('sidebar.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">

            <div class="topbar">
                <h1>EVENCIA</h1>

                <div class="topbar-right">

                    <div class="search-box position-relative">

                    <form action="{{ route('superadmin.search') }}" method="GET">
                        <!-- <svg viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.3-4.3"/>
                        </svg> -->

                        <input
                            type="text"
                            name="search"
                            id="globalSearch"
                            class="form-control border-0 shadow-none"
                            placeholder="Quick search..."
                            autocomplete="off">

                        <div id="searchResults"
                            class="list-group position-absolute w-100 mt-1 shadow"
                            style="z-index:999; display:none;">
                        </div>
                    </form>

                    </div>

                    <div class="icon-btn">
                        <svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        <span class="dot"></span>
                    </div>

                    @auth
                    @php
                        $names = explode(' ', Auth::user()->name);
                        $initials = strtoupper(
                            substr($names[0], 0, 1) .
                            (count($names) > 1
                                ? substr($names[count($names)-1], 0, 1)
                                : '')
                        );
                    @endphp

                    <div class="dropdown">

                        <div class="profile-avatar dropdown-toggle"
                            data-bs-toggle="dropdown"
                            style="cursor:pointer;">

                            {{ $initials }}
                        </div>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li class="px-3 py-2">
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <small class="text-muted">
                                    {{ Auth::user()->email }}
                                </small>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST"
                                        action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </div>
                @endauth
                </div>
            </div>

            <div class="row">

                <!-- Left Section -->
                <div class="col-lg-8">

                    <!-- Stats -->
                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted fw-semibold">
                                            Total Admins
                                        </small>

                                        <span class="badge bg-success rounded-circle p-2"></span>
                                    </div>

                                    <h2 class="fw-bold text-primary mt-3">
                                        {{ $totalAdmins ?? 12 }}
                                    </h2>

                                    <small class="text-success">
                                        Active
                                    </small>

                                    <div class="progress mt-3" style="height:4px;">
                                        <div class="progress-bar bg-primary w-100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted fw-semibold">
                                            Total Events
                                        </small>

                                        
                                    </div>

                                    <h2 class="fw-bold text-primary mt-3">
                                        {{  $totalEvents ?? 56 }}
                                    </h2>

                                    <small class="text-primary">
                                        Running
                                    </small>


                                    <div class="progress mt-3" style="height:4px;">
                                        <div class="progress-bar bg-info w-100"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted fw-semibold">
                                            Revenue
                                        </small>

                                        
                                    </div>

                                    <h2 class="fw-bold text-primary mt-3">
                                        ₹{{ number_format( $totalRevenue ?? 145000) }}
                                    </h2>

                                    <small class="text-danger">
                                        Total
                                    </small>

                                    <div class="progress mt-3" style="height:4px;">
                                        <div class="progress-bar bg-warning w-100"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Revenue -->
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">

                                <div>
                                    <h4 class="fw-bold mb-0">
                                        Platform Revenue
                                    </h4>

                                    <small class="text-muted">
                                        Daily earnings visualization
                                    </small>
                                </div>

                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    ₹{{ number_format($totalRevenue ?? 145000) }}
                                </span>

                            </div>

                            <canvas id="revenueChart" height="100"></canvas>

                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold mb-0">Upcoming Events</h4>

                                <a href="{{ route('admin.shows.index') }}"
                                class="text-decoration-none small fw-semibold">
                                    View All
                                </a>
                            </div>

                            @forelse($upcomingEvents as $show)

                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                    <div>
                                        <h6 class="mb-1 fw-semibold">
                                            {{ $show->event->event_name }}
                                        </h6>

                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($show->show_date)->format('d M Y') }}
                                            •
                                            {{ \Carbon\Carbon::parse($show->show_time)->format('h:i A') }}
                                        </small>

                                        <br>

                                        <small class="text-primary">
                                            {{ $show->venue->venue_name }}
                                        </small>
                                    </div>

                                    <span class="badge bg-success">
                                        Upcoming
                                    </span>

                                </div>

                            @empty

                                <div class="text-center py-4">
                                    <p class="text-muted mb-0">
                                        No upcoming events available.
                                    </p>
                                </div>

                            @endforelse

                        </div>
                    </div>

                    <!-- Event  -->

                    <div class="card shadow-sm border-0 rounded-4 mt-4">
                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                Event Performance
                            </h4>

                            <div class="table-responsive">

                                <table class="table align-middle">

                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Tickets Sold</th>
                                            <th>Seats Left</th>
                                            <th>Occupancy</th>
                                            <th>Revenue</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($eventPerformance as $event)

                                        <tr>

                                            <td>{{ $event['event'] }}</td>

                                            <td>{{ $event['tickets_sold'] }}</td>

                                            <td>{{ $event['remaining'] }}</td>

                                            <td>

                                                <div class="progress" style="height:8px;">
                                                    <div class="progress-bar bg-success"
                                                        style="width:{{ $event['occupancy'] }}%">
                                                    </div>
                                                </div>

                                                <small>
                                                    {{ $event['occupancy'] }}%
                                                </small>

                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹{{ number_format($event['revenue']) }}
                                            </td>

                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>

                </div>

                <!-- Right Section -->
                <div class="col-lg-4">

                    <!-- Logs -->
                    <div class="card shadow-sm border-0 rounded-4 mb-4">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">

                                <h4 class="fw-bold">
                                    System Logs
                                </h4>

                                <a href="#" class="small">
                                    View Audit
                                </a>

                            </div>

                            <ul class="list-group list-group-flush">

                                @forelse($logs as $log)

                                    <li class="list-group-item">

                                        
                                        {{ $log['message'] }}

                                        <br>

                                        <small class="text-muted">
                                            {{ $log['time']->diffForHumans() }}
                                        </small>

                                    </li>

                                @empty

                                    <li class="list-group-item text-center text-muted">
                                        No activities found.
                                    </li>

                                @endforelse

                            </ul>

                        </div>

                    </div>

                    <!-- Top Venues -->
                    <div class="card shadow-sm border-0 rounded-4 mb-4">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold mb-0">Top Performing Venue</h4>

                                <a href="{{ route('admin.venues.index') }}"
                                class="text-decoration-none small fw-semibold">
                                    View All
                                </a>
                            </div>

                            @foreach($topVenues ?? [] as $venue)

                                <div class="d-flex align-items-center mb-3">

                        

                                    <div class="flex-grow-1">

                                        <strong>
                                            {{ $venue->name }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $venue->location }}
                                        </small>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                    <!-- Recent Bookings -->
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="fw-bold mb-0">Recent Bookings</h4>
                                <a href="{{ route('admin.bookings.index') }}"
                                class="text-decoration-none small fw-semibold">
                                    View All
                                </a>
                            </div>

                            @forelse($recentBookings as $booking)

                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                    <div>
                                        <h6 class="mb-1">
                                            {{ $booking->show->event->event_name }}
                                        </h6>

                                        <small class="text-muted">
                                            {{ $booking->user->name }}
                                        </small>

                                        <br>

                                        <small class="text-primary">
                                            {{ $booking->created_at->format('d M Y, h:i A') }}
                                        </small>
                                    </div>

                                    <span class="badge bg-success">
                                        ₹{{ number_format($booking->total_amount) }}
                                    </span>

                                </div>

                            @empty

                                <div class="text-center py-4">
                                    No bookings yet.
                                </div>

                            @endforelse

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('revenueChart');
const revenue = @json($revenue);

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],
        datasets: [{
            label: 'Revenue',
            data: revenue,
            borderColor: '#4F46E5',
            backgroundColor: 'rgba(79,70,229,0.15)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


const input = document.getElementById('globalSearch');
const results = document.getElementById('searchResults');

input.addEventListener('keyup', function () {

    let value = this.value;

    if(value.length < 2){
        results.style.display = 'none';
        results.innerHTML = '';
        return;
    }

    fetch(`/search?search=${value}`)
        .then(response => response.json())
        .then(data => {

            results.innerHTML = '';

            if(data.length == 0){
                results.innerHTML =
                    '<div class="list-group-item">No results found</div>';
            }else{

                data.forEach(item => {

                    results.innerHTML += `
                        <a href="/admin/events/${item.id}"
                           class="list-group-item list-group-item-action">
                            ${item.event_name}
                        </a>
                    `;

                });

            }

            results.style.display = 'block';

        });

});

document.addEventListener('click', function(e){

    if(!document.querySelector('.search-box').contains(e.target)){
        results.style.display='none';
    }

});

</script>
</body>
</html>