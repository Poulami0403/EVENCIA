@extends('usermaster')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-4">Booking History</h3>

    {{-- Search + Filter --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

        <div class="mb-4">
            <form method="GET" action="{{ route('bookings.history') }}">
                <div class="input-group shadow-sm rounded-pill overflow-hidden">

                    <span class="input-group-text bg-white border-0 ps-4">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 py-3"
                        placeholder="Search by event, category or venue...">

                    <button type="submit"
                            class="btn px-4 text-white fw-semibold"
                            style="background-color: #3b2fc9;">
                        Search
                    </button>

                </div>
            </form>
        </div>

        <div class="d-flex gap-2 mt-2 mt-md-0">
            <button class="btn btn-sm btn-primary rounded-pill px-3">All</button>
            <button class="btn btn-sm btn-light rounded-pill px-3">Upcoming</button>
            <button class="btn btn-sm btn-light rounded-pill px-3">Past</button>
            <button class="btn btn-sm btn-light rounded-pill px-3">Cancelled</button>
        </div>

    </div>

    {{-- Booking Cards --}}
    <div class="row">

        @forelse($bookings as $booking)

            @php
                $show = $booking->show;
                $event = $show?->event;
                $venue = $show?->venue;

                $seatNumbers = $booking->bookingSeats
                    ->map(function($seat){
                        return $seat->showSeat->seat->seat_no;
                    })
                    ->implode(', ');
            @endphp

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100 border-0">

                    {{-- Event Image --}}
                    <div class="position-relative">

                        <img src="{{ asset('uploads/'.$event->image) }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover;">

                        <span class="badge bg-success position-absolute top-0 end-0 m-2">
                            {{ $booking->status? 'Confirmed' : 'Pending'}}
                        </span>

                    </div>

                    <div class="card-body">

                        <h5 class="fw-bold">
                            {{ $event->event_name }}
                        </h5>

                        <small class="text-muted d-block mb-2">
                            {{ $venue?->venue_name }}
                        </small>

                        <p class="mb-1">
                            <i class="fi fi-sr-map-pin myicon"></i> {{ $venue?->location ?? 'Location Not Available' }} 
                        </p>

                        <p class="mb-1">
                            <i class="fi fi-sr-ticket-alt myicon"></i> Seats: 
                            @foreach($booking->bookingSeats as $bookingSeat)
                                {{ $bookingSeat->showSeat->seat->seat_no }}
                                @if(!$loop->last), @endif
                            @endforeach
                        </p>

                        <p class="mb-1">
                            <i class="fi fi-sr-daily-calendar myicon"></i> Date:
                            {{ $show?->show_date ?? 'N/A' }}
                        </p>

                        <p class="mb-3">
                            <i class="fi fi-sr-sack-dollar myicon"></i> Price:
                            ₹{{ $booking->total_amount }}
                        </p>

                        <div class="d-flex gap-2">

                            <a href="{{ route('bookings.ticket',$booking->id) }}"
                               class="btn btn-primary btn-sm w-100">
                                View Ticket
                            </a>

                            <button class="btn btn-outline-secondary btn-sm w-100">
                                Rebook
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info text-center">
                    No bookings found.
                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection