@php
use Illuminate\Support\Facades\Session;
@endphp

@extends('master')
@section('content')

<div class="container-fluid">
    <div class="row">


        {{-- MAIN CONTENT --}}
        <div class="col-md-9 col-lg-10 p-4">

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="view-btn mt-3 text-end">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
            </div>

            <div class="form-card">
                <h2 class="text-center mb-4 fw-bold text-dark">Edit Event</h2>

                <form action="{{ route('admin.events.update', encrypt($event->id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Event Name --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Event Name</label>
                        <input type="text"
                            name="event_name"
                            value="{{ old('event_name', $event->event_name) }}"
                            class="form-control form-control-lg fs-6"
                            required>
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Category</label>
                        <select name="category" class="form-control form-control-lg fs-6" required>
                            <option value="">Select Category</option>
                            <option value="Movie" {{ $event->category == 'Movie' ? 'selected' : '' }}>Movie</option>
                            <option value="Concert" {{ $event->category == 'Concert' ? 'selected' : '' }}>Concert</option>
                            <option value="Sports" {{ $event->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Theatre" {{ $event->category == 'Theatre' ? 'selected' : '' }}>Theatre</option>
                            <option value="Festival" {{ $event->category == 'Festival' ? 'selected' : '' }}>Festival</option>
                            <option value="Workshop" {{ $event->category == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="Comedy Show" {{ $event->category == 'Comedy Show' ? 'selected' : '' }}>Comedy Show</option>
                        </select>
                    </div>

                    {{-- Details --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Event Details</label>
                        <textarea name="event_details"
                                class="form-control form-control-lg fs-6"
                                rows="3"
                                required>{{ old('event_details', $event->event_details) }}</textarea>
                    </div>

                    {{-- Duration --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Duration (minutes)</label>
                        <input type="number"
                            name="duration"
                            value="{{ old('duration', $event->duration) }}"
                            class="form-control form-control-lg fs-6"
                            required>
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Upload Image</label>
                        <input type="file"
                            name="image"
                            class="form-control form-control-lg fs-6"
                            accept="image/*">

                        @if($event->image)
                            <img src="{{ asset('uploads/'.$event->image) }}" class="w-50 mt-2">
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Status</label>
                        <select name="status" class="form-control form-control-lg fs-6" required>
                            <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                        Update
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
