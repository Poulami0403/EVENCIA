<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\ShowSeat;
use App\Models\Seat;
use App\Models\BookingSeat;
use App\Models\Payment;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(
            'show.event',
            'show.venue'
        )->latest()->get();

        return view('bookings.index', compact('bookings'));
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
    $request->validate([
        'show_id' => 'required|exists:shows,id',
        'selected_seats' => 'required',
        'total_amount' => 'required|numeric|min:1'
    ]);

    $booking = Booking::create([
        'user_id' => auth()->id(),
        'show_id' => $request->show_id,
        'customer_name' => auth()->user()->name,
        'customer_email' => auth()->user()->email,
        'total_amount' => $request->total_amount,
        'status' => 0
    ]);

    $show = Show::findOrFail($request->show_id);

    $seats = explode(',', $request->selected_seats);

    foreach ($seats as $seatNo) {

        $seat = Seat::where('venue_id', $show->venue_id)
            ->where('seat_no', trim($seatNo))
            ->firstOrFail();

        $showSeat = ShowSeat::where('show_id', $show->id)
            ->where('seat_id', $seat->id)
            ->firstOrFail();

        BookingSeat::create([
            'booking_id' => $booking->id,
            'show_seat_id' => $showSeat->id,
        ]);

        $showSeat->update([
            'status' => 0
        ]);
    }
    $this->payment($booking);

    return redirect()
        ->route('bookings.ticket', $booking->id)
        ->with('success', 'Booking successful');
}

        

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function layout($id)
    {
        $id = decrypt($id);
        $show = Show::findOrFail($id);
        $showSeats = ShowSeat::with('seat')->where('show_id', $id)->get();

        return view('bookings.layout',compact('show','showSeats'));
    }

    public function ticket($id)
    {
        $booking = Booking::with(
            'show.event',
            'show.venue',
            'bookingSeats.showSeat.seat'
        )->findOrFail($id);

        return view('bookings.ticket', compact('booking'));
    }

  
    public function history(Request $request)
    {
        $bookings = Booking::with([
            'show.event',
            'show.venue',
            'bookingSeats.showSeat.seat'
        ])
        ->where('user_id', auth()->id());

        if ($request->filled('search')) {
            $bookings->whereHas('show.event', function ($query) use ($request) {
                $query->where('event_name', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $bookings->latest()->get();

        return view('bookings.history', compact('bookings'));
    }
    

    public function acknowledgement($id)
    {
        $bookings = Booking::with(
            'show.event',
            'show.venue'
        )->findOrFail($id);

        return view(
            'bookings.acknowledgement',
            compact('bookings')
        );
    }

    public function payment($booking)
    {
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_amount,
            'payment_method' => 'Card',
            'transaction_id' => 'TXN' . time(),
            'payment_status' => 1,
            'paid_at' => now(),
        ]);

        $booking->update([
            'status' => 'confirmed'
        ]);
    }

    public function adminIndex()
    {
        $bookings = Booking::with([
            'user',
            'show.event',
            'show.venue',
            'bookingSeats.showSeat.seat',
            'payment'
        ])->latest()->get();

        return view('admin.bookings.list', compact('bookings'));
    }
}
