@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">

       

        {{-- MAIN CONTENT --}}
       

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="page-header mb-4">
                <h2 class="fw-bold mb-1">Create Event</h2>
                <p class="text-muted">
                    Add a new event to the ticket booking system.
                </p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">

                    <form action="{{ route('admin.events.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Event Name
                                </label>
                                <input type="text"
                                       name="event_name"
                                       value="{{ old('event_name') }}"
                                       class="form-control form-control-lg"
                                       placeholder="Enter Event Name"
                                       required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Category
                                </label>

                                <select name="category"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="">Select Category</option>
                                    <option value="Movie">Movie</option>
                                    <option value="Concert">Concert</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Theatre">Theatre</option>
                                    <option value="Festival">Festival</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Comedy Show">Comedy Show</option>
                                </select>
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label fw-semibold">
                                    Event Details
                                </label>

                                <textarea name="event_details"
                                          rows="5"
                                          class="form-control form-control-lg"
                                          placeholder="Enter Event Details"
                                          required>{{ old('event_details') }}</textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Event Duration (Minutes)
                                </label>

                                <input type="number"
                                       name="duration"
                                       class="form-control form-control-lg"
                                       placeholder="120"
                                       required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Upload Image
                                </label>

                                <input type="file"
                                       name="image"
                                       class="form-control form-control-lg"
                                       accept="image/*"
                                       required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <button type="submit"
                                        class="btn btn-primary btn-lg px-5">
                                    Create Event
                                </button>

                                <a href="{{ route('events.index') }}"
                                   class="btn btn-outline-secondary btn-lg ms-2">
                                    Cancel
                                </a>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection