<?php

namespace App\Http\Controllers;

use App\Models\AdminBooking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(
            'show.event',
            'show.venue',
            'bookingSeats.showSeat.seat'
        )->latest()->get();

        return view(
            'bookings.index',
            compact('bookings')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminBooking $adminBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminBooking $adminBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminBooking $adminBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminBooking $adminBooking)
    {
        //
    }
}
