@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Venue Information Form</title>

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
      <h2 class="text-center mb-4 fw-bold text-dark">Venue Details</h2>

      <form action="{{route('admin.venues.store')}}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-semibold text-secondary">Venue Name</label>
        <input type="text" name="venue_name" value="{{ old('venue_name') }}"
               class="form-control form-control-lg fs-6"
               placeholder="Enter Venue Name" required>
    </div>

    <!-- <div class="mb-3">
        <label class="form-label fw-semibold text-secondary">Category</label>

        <select name="category" class="form-control form-control-lg fs-6" required>
            <option value="">Select Category</option>
            <option value="Movie">Movie</option>
            <option value="Concert">Concert</option>
            <option value="Sports">Sports</option>
            <option value="Theatre">Theatre</option>
            <option value="Festival">Festival</option>
            <option value="Workshop">Workshop</option>
            <option value="Comedy Show">Comedy Show</option>
        </select>
    </div> -->

    <div class="mb-3">
        <label class="form-label fw-semibold text-secondary">Venue Location</label>
        <textarea name="location"
                  class="form-control form-control-lg fs-6"
                  rows="2"
                  placeholder="Enter Venue Location"
                  required>{{ old('location') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold text-secondary">Capacity</label>
        <input type="number" name="capacity"
               class="form-control form-control-lg fs-6"
               placeholder = 0
               required>
    </div>


    <div class="mb-3">
        <label class="form-label fw-semibold text-secondary">Status</label>

        <select name="status" class="form-control form-control-lg fs-6" required>
            <option value="">Select Status</option>
            <option value="1">Available</option>
            <option value="0">Unavailable</option>
        </select>
    </div>

    <button type="submit"
            class="btn btn-primary btn-lg w-100 fs-6 fw-bold shadow-sm">
        Submit
    </button>
</form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>