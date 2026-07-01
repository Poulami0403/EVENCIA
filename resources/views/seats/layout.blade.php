
@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">


        <div class="col-md-9 col-lg-10">

        <div class="view-btn mt-3 text-end">
            <a href="{{ route('admin.shows.index') }}" class="btn btn-secondary">Back</a>
        </div>

            <h2>{{ $show->event->event_name }}</h2>
            @php
            $premium = $showSeats
                        ->filter(fn($s) => $s->seat->seat_type == 'Premium')
                        ->groupBy(fn($s) => substr($s->seat->seat_no,0,1));

            $standard = $showSeats
                        ->filter(fn($s) => $s->seat->seat_type == 'Standard')
                        ->groupBy(fn($s) => substr($s->seat->seat_no,0,1));
            @endphp

            <h3>Premium</h3>

            @foreach($premium as $row => $seats)

            <div class="seat-row">

                <span class="row-label">
                    {{ $row }}
                </span>

                @foreach($seats as $seat)

                    <span class="seat {{ $seat->status == '0' ? 'booked' : '' }}">
                        {{ substr($seat->seat->seat_no,1) }}
                    </span>

                @endforeach

            </div>

            @endforeach


            <h3>Standard</h3>

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

            <!-- <form action="#" method="POST">
                @csrf

                <input type="hidden"
                    name="selected_seats"
                    id="selected_seats">

                <button type="submit"
                        class="btn btn-primary mt-4">
                    Book Selected Seats
                </button>
            </form> -->
        </div>
    </div>
</div>

<script>
    let selected = [];

document.querySelectorAll('.seat').forEach(seat => {

    seat.addEventListener('click', function () {

        if (this.classList.contains('booked'))
            return;

        this.classList.toggle('selected');

        let seatNo = this.dataset.seat;

        if (selected.includes(seatNo)) {
            selected = selected.filter(s => s !== seatNo);
        } else {
            selected.push(seatNo);
        }

        document.getElementById('selected_seats').value =
            selected.join(',');
    });

});
</script>

@endsection
