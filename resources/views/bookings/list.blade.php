@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seat List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/seatlist.css') }}">

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
                <h3 class="fw-bold">Seat List</h3>

                <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#seatModal">
                    + Create Seat
                </button>
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
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($seatRanges as $seat)
                        <tr>
                            <td>{{ $seat->venue->venue_name }}</td>
                            <td>{{ $seat->seat_type }}</td>
                            <td>{{ $seat->start_seat }} - {{ $seat->end_seat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Seat Modal -->
                <div class="modal fade"
                    id="seatModal"
                    tabindex="-1"
                    aria-labelledby="seatModalLabel"
                    aria-hidden="true">

                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="seatModalLabel">
                                    Generate Seats
                                </h5>

                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                </button>
                            </div>

                            <div class="modal-body">

                                <form action="{{ route('admin.bookings.index') }}"
                                    method="POST">

                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Select Venue
                                        </label>

                                        <select name="venue_id"
                                                class="form-select"
                                                required>

                                            <option value="">
                                                -- Select Venue --
                                            </option>

                                            @foreach($venues as $venue)
                                                <option value="{{ $venue->id }}">
                                                    {{ $venue->venue_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <button type="submit"
                                            class="btn btn-primary w-100">
                                        Generate Seats
                                    </button>

                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>