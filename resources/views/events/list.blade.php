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

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold" style =" font-size: 1.75rem">Events List</h3>

                <a href="{{ route('admin.events.create') }}" class="btn btn-primary px-4 py-2">
                    + Create Event
                </a>
            </div>

            <div class="row g-4">

                @forelse($events as $event)

                    <div class="col-md-6 col-lg-4">
                        <div class="event-card">

                            <div class="event-img-wrap">
                                <img src="{{ asset('uploads/'.$event->image) }}"
                                     alt="{{ $event->event_name }}">
                            </div>

                            <div class="event-content">

                                <h5>{{ $event->event_name }}</h5>

                                <p>{{ Str::limit($event->event_details, 100) }}</p>

                                <div class="d-flex justify-content-between mb-3">
                                    <span>{{ $event->duration }} min</span>

                                    @if($event->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('admin.events.edit',encrypt($event->id)) }}"
                                       class="btn btn-primary w-50">
                                        Edit
                                    </a>

                                    <a href="{{ route('admin.events.shows', encrypt($event->id)) }}"
                                        class="btn btn-sm btn-info">
                                        Manage Shows
                                    </a>
                                    
                                    <a href="#"
                                       onclick="deleteTask({{ $event->id }}); return false;"
                                       class="btn btn-danger w-50">
                                        Delete
                                    </a>

                                    <form id="dlt{{ $event->id }}"
                                          action="{{ route('admin.events.destroy',encrypt($event->id)) }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No events found.
                        </div>
                    </div>
                @endforelse

            </div>

    </div>
</div>
@endsection

