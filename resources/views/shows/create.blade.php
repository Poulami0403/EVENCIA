@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Information Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        padding: 30px 15px;
      }
      .container {
          width: 100%;
      }
      .form-card{
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,.05);
        width: 100%;
        max-width: 500px;
        padding: 2.5rem;
      }
    </style>
</head>
<body>

  
<div class="container" style="max-width:600px;">
  @if(Session::has('success'))
      <div class="alert alert-success">
          {{ Session::get('success') }}
      </div>
  @endif

  
<div class="form-card">
    <h2 class="text-center mb-4 fw-bold text-dark">Seat Details</h2>

<form action="{{ route('admin.shows.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <!-- <label class="form-label">Select Event</label>
        <select name="event_id" class="form-control" required>
            <option value="">-- Select Event --</option> -->
                @if($event)

                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="mb-3">
                    <label>Event</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $event->event_name }}"
                        readonly>
                </div>

            @else

                <div class="mb-3">
                    <label>Event</label>

                    <select name="event_id" class="form-control">
                        @foreach($events as $ev)
                            <option value="{{ $ev->id }}">
                                {{ $ev->event_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            @endif
        <!-- </select> -->
    </div>

    <div class="mb-3">
        <label class="form-label">Select Venue</label>
        <select name="venue_id" class="form-control" required>
            <option value="">-- Select Venue --</option>
            @foreach($venues as $venue)
                <option value="{{ $venue->id }}">
                    {{ $venue->venue_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Show Date</label>
        <input type="date" name="show_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Show Time</label>
        <input type="time" name="show_time" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Ticket Price</label>
        <input type="number" name="ticket_price" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Create Shows
    </button>
</form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>