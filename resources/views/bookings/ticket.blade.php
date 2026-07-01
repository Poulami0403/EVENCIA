<!DOCTYPE html>
<html>
<head>
    <title>E-Ticket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f6fa;
            padding:50px;
        }

        .ticket-card{
            max-width:700px;
            margin:auto;
            background:white;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
            overflow:hidden;
        }

        .ticket-header{
            background:#6f42c1;
            color:white;
            padding:25px;
            text-align:center;
        }

        .ticket-body{
            padding:35px;
        }

        .info-row{
            display:flex;
            justify-content:space-between;
            margin-bottom:18px;
            border-bottom:1px solid #eee;
            padding-bottom:10px;
        }

        .label{
            font-weight:bold;
            color:#555;
        }

        .value{
            color:#222;
        }

        .status{
            background:#198754;
            color:white;
            padding:5px 15px;
            border-radius:20px;
        }
    </style>
</head>
<body>

<div class="ticket-card">

    <div class="ticket-header">
        <h2>E-Ticket</h2>
        <h4>{{ $booking->show->event->event_name }}</h4>
    </div>

    <div class="ticket-body">

        <div class="info-row">
            <span class="label">Booking ID</span>
            <span class="value">#{{ $booking->id }}</span>
        </div>

        <div class="info-row">
            <span class="label">Customer Name</span>
            <span class="value">
                {{ $booking->customer_name }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Email</span>
            <span class="value">
                {{ $booking->customer_email }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Venue</span>
            <span class="value">
                {{ $booking->show->venue->venue_name }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Date</span>
            <span class="value">
                {{ $booking->show->show_date }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Time</span>
            <span class="value">
                {{ $booking->show->show_time }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Seats</span>
            <span class="value">


                @foreach($booking->bookingSeats as $bookingSeat)
                    {{ $bookingSeat->showSeat->seat->seat_no }}
                    @if(!$loop->last), @endif
                @endforeach

            </span>
        </div>

        <div class="info-row">
            <span class="label">Total Amount</span>
            <span class="value">
                ₹{{ $booking->total_amount }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Status</span>
            <span class="status">
                {{ $booking->status == 0 ? 'Booked' : 'Available' }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Booked On</span>
            <span class="value">
                {{ $booking->created_at->format('d M Y h:i A') }}
            </span>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home.index') }}"
               class="btn btn-primary">
                Back to Home
            </a>

            <button type="button" class="btn btn-success" onclick="printTicket()">
                Print Ticket
            </button>
        </div>

    </div>

</div>
<script>
function printTicket() {
    window.print();
}
</script>
</body>
</html>