<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store($bookingId)
    {
         $booking = Booking::findOrFail($bookingId);

        Payment::create([
            'booking_id'      => $booking->id,
            'amount'          => $booking->total_amount,
            'payment_method'  => 'Card',
            'transaction_id'  => 'TXN'.time(),
            'payment_status'  => 'Success',
            'paid_at'         => now()
        ]);

        $booking->update([
            'status' => 'Confirmed'
        ]);

        return redirect()->route(
            'booking.ticket',
            $booking->id
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
