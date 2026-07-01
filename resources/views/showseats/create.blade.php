<!-- @php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Seat Information Form</title>

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
    <h2 class="text-center mb-4 fw-bold text-dark">Show Seat Details</h2>

<form action="{{ route('showseats.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Select Event</label>
        <select name="event_id" class="form-control" required>
            <option value="">-- Select Show --</option>
            @foreach($events as $event)
                <option value="{{ $event->id }}">
                    {{ $event->event_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Select Seat</label>
        <select name="seat_id" class="form-control" required>
            <option value="">-- Select  --</option>
            @foreach($seats as $seat)
                <option value="{{ $seat->id }}">
                    {{ $seat->seat_no }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="1">Available</option>
            <option value="0">Booked</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Create 
    </button>
</form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> -->