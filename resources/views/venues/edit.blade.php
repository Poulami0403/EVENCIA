@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Venue</title>

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
        <a href="{{ route('admin.venues.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="form-card">
        <h2 class="text-center mb-4 fw-bold text-dark">Edit Venue</h2>

        <form action="{{ route('admin.venues.update', $venue->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- venue Name --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Venue Name</label>
                <input type="text"
                       name="venue_name"
                       value="{{ old('venue_name', $venue->venue_name) }}"
                       class="form-control form-control-lg fs-6"
                       required>
            </div>

            {{-- Location --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">venue Location</label>
                <textarea name="location"
                          class="form-control form-control-lg fs-6"
                          rows="3"
                          required>{{ old('location', $venue->location) }}</textarea>
            </div>

            {{-- Capacity --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Capacity</label>
                <input type="number"
                       name="capacity"
                       value="{{ old('capacity', $venue->capacity) }}"
                       class="form-control form-control-lg fs-6"
                       required>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Status</label>
                <select name="status" class="form-control form-control-lg fs-6" required>
                    <option value="1" {{ $venue->status == 1 ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ $venue->status == 0 ? 'selected' : '' }}>Unavailable</option>
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