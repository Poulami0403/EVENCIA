@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/seatlist.css') }}">

    <style>
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
    </style>
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

                <div>
                    @if(isset($event))
                        <h3 class="fw-bold mb-1">
                            Shows for {{ $event->event_name }}
                        </h3>

                        <small class="text-muted">
                            Manage all show timings for this event
                        </small>
                    @else
                        <h3 class="fw-bold mb-1">
                            All Shows
                        </h3>

                        <small class="text-muted">
                            Manage all event shows
                        </small>
                    @endif
                </div>

                                @if(isset($event))

                <a href="{{ route('admin.shows.create', ['event_id' => $event->id]) }}"
                class="btn btn-primary">
                    + Create Show
                </a>

                @else

                <a href="{{ route('admin.shows.create') }}"
                class="btn btn-primary">
                    + Create Show
                </a>

                @endif

            </div>

            <div class="card-box">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Venue Name</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Ticket Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($shows as $show)
                        <tr>
                            <td>{{ $show->event->event_name }}</td>
                            <td>{{ $show->venue->venue_name }}</td>
                            <td>{{ $show->show_date }}</td>
                            <td>{{ $show->show_time }}</td>
                            <td>{{ $show->ticket_price}}</td>
                            <td>
                                @if($show->status)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Unavailable</span>
                                @endif
                            </td>
                            <td>
                    
                                <a href="{{ route('admin.seats.layout',$show->id) }}"
                                class="btn btn-sm text-white"
                                style="background:#20c997;">
                                Seats
                                </a>

                                <a href="{{ route('admin.shows.edit',$show->id) }}"
                                class="btn btn-sm text-white"
                                style="background:#6f42c1;">
                                    Edit
                                </a>

                                <a href="#"
                                onclick="deleteShow({{ $show->id }}); return false;"
                                class="btn btn-danger btn-sm">
                                    Delete
                                </a>

                                <form id="dlt{{ $show->id }}"
                                    action="{{ route('admin.shows.destroy', $show->id) }}"
                                    method="POST"
                                    class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    <div>
<div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function deleteShow(id) {
    if (confirm('Are you sure you want to delete this show?')) {
        document.getElementById('dlt' + id).submit();
    }
}
</script>

</body>
</html>