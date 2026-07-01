@extends('master')
@section('content')
  
<div class="container" style="max-width:600px;">
  @if(Session::has('success'))
      <div class="alert alert-success">
          {{ Session::get('success') }}
      </div>
  @endif

  
<div class="form-card">
    <h2 class="text-center mb-4 fw-bold text-dark">Seat Details</h2>

<form action="{{ route('admin.seats.store') }}" method="POST">
    @csrf
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
    <button type="submit" class="btn btn-primary w-100">
        Generate Seats
    </button>
</form>
  </div>
</div>
@endsection