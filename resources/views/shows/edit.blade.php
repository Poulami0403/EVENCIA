@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Show</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        padding: 30px 15px;
      }
      .container { width: 100%; }

      .form-card {
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

    <div class="view-btn mt-3">
        <a href="{{ route('admin.shows.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="form-card">
        <h2 class="text-center mb-4 fw-bold text-dark">Edit Show</h2>

        <form action="{{ route('admin.shows.update', $show->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- show Name --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">--Select Event--</label>

                <select name="event_id" class="form-control" required>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}"
                            {{ $event->id == old('event_id', $show->event_id) ? 'selected' : '' }}>
                            {{ $event->event_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Location --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">--Select Venue--</label>
                <select name="venue_id" class="form-control" required>
                    @foreach($venues as $venue)
                        <option value="{{ $venue->id }}"
                            {{ $venue->id == old('venue_id', $show->venue_id) ? 'selected' : '' }}>
                            {{ $venue->venue_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Date --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Event Date</label>
                <input type="date"
                       name="show_date"
                       value="{{ old('show_date', $show->show_date) }}"
                       class="form-control form-control-lg fs-6"
                       required>
            </div>

            {{-- Time --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Event Time</label>
                <input type="time"
                       name="show_time"
                       value="{{ old('show_time', $show->show_time) }}"
                       class="form-control form-control-lg fs-6"
                       required>
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Ticket Price</label>
                <input type="number"
                       name="ticket_price"
                       value="{{ old('ticket_price', $show->ticket_price) }}"
                       class="form-control form-control-lg fs-6"
                       required>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Status</label>
                <select name="status" class="form-control form-control-lg fs-6" required>
                    <option value="1" {{ $show->status == 1 ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ $show->status == 0 ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                Update
            </button>

        </form>
    </div>

</div>

</body>
</html>