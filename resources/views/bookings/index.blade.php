@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">


    <!-- <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1100px;
        }

        .card-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            padding: 20px;
        }

        img {
            border-radius: 8px;
            object-fit: cover;
        }
    </style> -->
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-3 col-lg-2 p-0">
            @include('sidebar.sidebar')
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-9 col-lg-10 p-4">

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold">Bookings</h3>

                <!-- <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#seatModal">
                    + Create Seat
                </button> -->
            </div>

            <div class="card-box">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Event</th>
                            <th>Seat</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Transaction ID</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->customer_name}}</td>
                            <td>{{ $booking->show->event->event_name }}</td>
                            <td>@foreach($booking->bookingSeats as $bookingSeat)
                                {{ $bookingSeat->showSeat->seat->seat_no }}
                                @if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>{{ $booking->show->ticket_price}}</td>
                            <td>{{ $booking->payment?->payment_status ? 'Paid' : 'Pending' }}</td>
                            <td>{{ $booking->payment?->transaction_id ?? 'N/A' }}</td>
                            
                        </tr>
                        @endforeach                   
                    </tbody>
                </table>
                
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>