<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    
    <div class="container mt-4">

        <!-- SHOW DETAILS -->
        <div class="show-card mb-4">

            <img src="{{ asset('uploads/'.$show->event->image) }}"
                class="movie-poster">

            <div class="show-info">

                <h3>{{ $show->event->event_name }}</h3>

                <div class="details">

                    <div>
                        
                        <strong>{{ $show->venue->venue_name }}</strong>
                    </div>

                    <div>
                        
                        <strong>{{ $show->show_date }}</strong>
                    </div>

                    <div>
                        
                        <strong>{{ $show->show_time }}</strong>
                    </div>

                </div>

            </div>

        </div>


        <div class="row">

            <!-- SEATS -->
            <div class="col-lg-8">

                <div class="seat-card">

                    <h4>Select Your Seats</h4>

                    <div class="legend">

                        <span>
                            <div class="box available"></div>
                            Available
                        </span>

                        <span>
                            <div class="box selected-box"></div>
                            Selected
                        </span>

                        <span>
                            <div class="box booked-box"></div>
                            Booked
                        </span>

                    </div>

                    <div class="screen">
                        SCREEN
                    </div>

                    {{-- KEEP YOUR EXISTING SEAT CODE HERE --}}

                   

                    @php
                    $premium = $showSeats
                                ->filter(fn($s) => $s->seat->seat_type == 'Premium')
                                ->groupBy(fn($s) => substr($s->seat->seat_no,0,1));

                    $standard = $showSeats
                                ->filter(fn($s) => $s->seat->seat_type == 'Standard')
                                ->groupBy(fn($s) => substr($s->seat->seat_no,0,1));
                    @endphp


                    @foreach($premium as $row => $seats)

                    <div class="seat-row">

                        <span class="row-label">
                            {{ $row }}
                        </span>

                        @foreach($seats as $seat)

                        <span
                            class="seat {{ $seat->status == 0 ? 'booked' : '' }}"
                            data-seat="{{ $seat->seat->seat_no }}">

                            {{ substr($seat->seat->seat_no,1) }}

                        </span>

                        @endforeach

                    </div>

                    @endforeach


                    @foreach($standard as $row => $seats)

                    <div class="seat-row">

                        <span class="row-label">
                            {{ $row }}
                        </span>

                        @foreach($seats as $seat)

                        <span
                            class="seat {{ $seat->status == 0 ? 'booked' : '' }}"
                            data-seat="{{ $seat->seat->seat_no }}">

                            {{ substr($seat->seat->seat_no,1) }}

                        </span>

                        @endforeach

                    </div>

                    @endforeach

                    <div class="selected-info">

                        Selected Seats:
                        <span id="seat-list"></span>

                        |

                        Total:
                        ₹<span id="total-price">0</span>

                    </div>

                </div>

            </div>


            <!-- CHECKOUT -->
            <div class="col-lg-4">

                <div class="checkout-card">

                    <h4>Checkout</h4>

                    <form id = "bookingForm"
                    action="{{ route('bookings.store') }}"
                        method="POST">

                        @csrf

                        <input type="hidden"
                            name="show_id"
                            value="{{ $show->id }}">

                        <input type="hidden"
                            id="selected_seats"
                            name="selected_seats">

                        <input type="hidden"
                            id="total_amount"
                            name="total_amount">

                        <div class="mb-3">

                            <label>
                                Full Name
                            </label>

                            <input type="text"
                                name="customer_name"
                                class="form-control"
                                value="{{ auth()->user()->name }}"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label>
                                Email
                            </label>

                            <input type="email"
                                name="customer_email"
                                class="form-control"
                                value="{{ auth()->user()->email }}"
                                readonly>

                        </div>

                        <button
                            type="button"
                            class="btn btn-book w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#ackModal">

                            Book Now
                        </button>
                        <!-- <button
                            class="btn btn-book w-100">

                            Book Now

                        </button> -->

                    </form>

                    <div class="modal fade"
                        id="ackModal"
                        tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        Acknowledgement
                                    </h5>

                                    <button type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <p>
                                        Please verify your booking details before proceeding.
                                    </p>

                                    <ul>
                                        <li>
                                            Seats:
                                            <span id="ackSeats"></span>
                                        </li>

                                        <li>
                                            Amount:
                                            ₹<span id="ackAmount"></span>
                                        </li>
                                    </ul>

                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">
                                        Cancel
                                    </button>

                                    <button type="button"
                                            class="btn btn-success"
                                            onclick="document.getElementById('bookingForm').submit();">

                                        Make Payment

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

    
           </div>

        </div>

    </div>
    <script>
        let selected = [];
        let price = {{ $show->ticket_price }};

        document.querySelectorAll('.seat').forEach(seat => {
            seat.addEventListener('click', function(){
                if(this.classList.contains('booked'))
                    return;

                this.classList.toggle('selected');

                let seatNo = this.dataset.seat;

                if(selected.includes(seatNo))
                {
                    selected =
                        selected.filter(
                            s => s !== seatNo
                        );
                }
                else
                {
                    selected.push(seatNo);
                }

                document.getElementById('seat-list')
                        .innerHTML =
                        selected.join(', ');

                document.getElementById(
                    'selected_seats'
                ).value =
                selected.join(',');

                document.getElementById(
                    'total-price'
                ).innerHTML =
                selected.length * price;

                document.getElementById('total_amount').value = selected.length * price;

            });

        });

       document.addEventListener('DOMContentLoaded', function () {

    const ackModal = document.getElementById('ackModal');

    if (ackModal) {
        ackModal.addEventListener('show.bs.modal', function () {

            document.getElementById('ackSeats').innerText =
                selected.join(', ');
            document.getElementById('ackAmount').innerText =
                selected.length * price;
        });
    }

});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
