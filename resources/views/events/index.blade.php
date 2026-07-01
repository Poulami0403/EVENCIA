@extends('usermaster')

@section('content')
<div class="container py-4" style="max-width: 1000px;">
    
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="color: #0f172a; font-size: 2rem;">Show Schedule</h1>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Explore and book your favorite performances this season.</p>
        </div>
        {{-- View toggles --}}
        <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
            <button class="btn btn-light bg-white border-0 p-2"><i class="bi bi-grid-3x3-gap"></i></button>
            <button class="btn btn-primary border-0 p-2" style="background-color: #3b2fc9;"><i class="bi bi-list-task"></i></button>
        </div>
    </div>
<!-- search -->
    <div class="mb-4">
    <form method="GET" action="{{ route('events.index') }}">
        <div class="input-group shadow-sm rounded-pill overflow-hidden">

            <span class="input-group-text bg-white border-0 ps-4">
                <i class="bi bi-search text-muted"></i>
            </span>

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control border-0 py-3"
                   placeholder="Search by event, category or venue...">

            <button type="submit"
                    class="btn px-4 text-white fw-semibold"
                    style="background-color: #3b2fc9;">
                Search
            </button>

        </div>
    </form>
</div>

    <div class="mb-4">

    {{-- Month Navigation --}}
    <div class="d-flex justify-content-between align-items-center mb-2">

        <span class="text-uppercase fw-bold text-muted"
              style="font-size:0.8rem; letter-spacing:0.5px;">
            {{ $monthStart->format('F Y') }}
        </span>

        <div>

            {{-- Previous Month --}}
            <a href="{{ route('events.index', [
                'month' => $monthStart->copy()->subMonth()->month,
                'year' => $monthStart->copy()->subMonth()->year
            ]) }}"
               class="btn btn-sm btn-link text-dark p-1 text-decoration-none">
                <i class="bi bi-chevron-left"></i>
            </a>

            {{-- Next Month --}}
            <a href="{{ route('events.index', [
                'month' => $monthStart->copy()->addMonth()->month,
                'year' => $monthStart->copy()->addMonth()->year
            ]) }}"
               class="btn btn-sm btn-link text-dark p-1 text-decoration-none">
                <i class="bi bi-chevron-right"></i>
            </a>

        </div>

    </div>

    {{-- Date Slider --}}
    <div class="row g-2 text-center flex-nowrap overflow-auto pb-2">

        @foreach($availableDates as $date)

            @php
                $dateStr = $date->toDateString();
                $isActive = ($selectedDateStr == $dateStr);
            @endphp

            <div class="col">

                <a href="{{ route('events.index', [
                    'date' => $dateStr,
                    'month' => $monthStart->month,
                    'year' => $monthStart->year
                ]) }}"
                   class="text-decoration-none">

                    <div
                        class="p-3 rounded-3 border-0 text-center {{ $isActive ? 'text-white' : 'bg-white text-dark shadow-sm' }}"
                        style="{{ $isActive ? 'background-color:#3b2fc9;' : 'background-color:#ffffff;' }} min-width:80px;">

                        <span
                            class="d-block text-uppercase {{ $isActive ? 'text-white-50' : 'text-muted' }}"
                            style="font-size:0.7rem; font-weight:600;">
                            {{ $date->format('D') }}
                        </span>

                        <span class="d-block fw-bold fs-4">
                            {{ $date->format('d') }}
                        </span>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

</div>
</div>

    {{-- Show Items List Container --}}
    <div class="d-flex flex-column gap-3 mb-4">
        @forelse($events as $event)
            @php
                $show = $event->shows->first();
                $categoryName = $event->category?->name ?? 'Event';
                
                // Color badge logic matching UI design styles 
                $badgeStyles = match(strtolower($categoryName)) {
                    'live music', 'concerts' => 'background-color: #e0f2fe; color: #0369a1;',
                    'dance' => 'background-color: #ffedd5; color: #c2410c;',
                    'workshop', 'workshops' => 'background-color: #e0e7ff; color: #4338ca;',
                    default => 'background-color: #f3f4f6; color: #374151;'
                };
            @endphp

            {{-- Horizontal List Item Row Layout --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-body p-3">
                    <div class="row align-items-center g-3">
                        
                        {{-- Image Segment --}}
                        <div class="col-12 col-sm-auto">
                            <img src="{{ asset('uploads/'.$event->image) }}"
                                 class="rounded-3 w-100"
                                 style="width: 160px; height: 100px; object-fit: cover;"
                                 alt="{{ $event->event_name }}">
                        </div>

                        {{-- Metadata Content Segment --}}
                        <div class="col col-sm">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                <span class="badge text-uppercase px-2 py-1 fw-bold" style="{{ $badgeStyles }} font-size: 0.65rem; letter-spacing: 0.3px;">
                                    {{ $categoryName }}
                                </span>
                                <span class="text-muted border-start ps-2" style="font-size: 0.8rem;">
                                    {{ $show?->duration ?? '1h 30m' }}
                                </span>
                            </div>

                            <h4 class="fw-bold mb-2 text-dark" style="font-size: 1.15rem; letter-spacing: -0.3px;">
                                {{ $event->event_name }}
                            </h4>

                            <div class="d-flex flex-wrap align-items-center gap-3 text-muted" style="font-size: 0.85rem;">
                                <div>
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $show?->show_time ?? '19:30 - 21:00' }}
                                </div>
                                <div>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $show?->venue?->location ?? 'Grand Lumina Hall' }}
                                </div>
                            </div>
                        </div>

                        {{-- Price and Actions Segment --}}
                        <div class="col-12 col-sm-auto text-sm-end d-flex flex-sm-column justify-content-between align-items-center align-items-sm-end gap-2 ms-sm-auto pe-sm-3">
                            <div>
                                @if($show?->ticket_price && $show->ticket_price > 0)
                                    <span class="fw-bold text-primary" style="font-size: 1.35rem; color: #3b2fc9 !important;">
                                        {{ number_format($show->ticket_price, 2) }}
                                    </span>
                                @else
                                    <span class="fw-bold text-success" style="font-size: 1.35rem;">
                                        FREE
                                    </span>
                                @endif
                            </div>
                            
                            <div>
                                @if($show)
                                    @if($show->ticket_price && $show->ticket_price > 0)
                                        <a href="{{ route('bookings.layout', $show->id) }}"
                                           class="btn px-4 py-2 text-white fw-medium rounded-pill"
                                           style="background-color: #2e22c2; font-size: 0.85rem; min-width: 110px;">
                                            Book Now
                                        </a>
                                    @else
                                        <a href="{{ route('bookings.layout', $show->id) }}"
                                           class="btn px-4 py-2 text-white fw-medium rounded-pill"
                                           style="background-color: #2e22c2; font-size: 0.85rem; min-width: 110px;">
                                            Register
                                        </a>
                                    @endif
                                @else
                                    <button class="btn btn-secondary px-4 py-2 fw-medium rounded-pill" style="font-size: 0.85rem;" disabled>
                                        Unavailable
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @empty
            <div class="p-5 text-center bg-white rounded-4 shadow-sm">
                <p class="text-muted mb-0">No shows listed for this date block. Please check back later!</p>
            </div>
        @endforelse
    </div>

    {{-- Floating Filter Button Component --}}
    <!-- <div class="position-fixed bottom-0 end-0 p-4" style="z-index: 1050;">
        <button class="btn d-flex align-items-center gap-2 px-4 py-2 text-white shadow-lg rounded-pill"
        style="background-color:#046a75"
        data-bs-toggle="offcanvas"
        data-bs-target="#filterCanvas">
    <i class="bi bi-sliders"></i>
    Filter Shows
</button> -->



    </div>
</div>

</div>
@endsection