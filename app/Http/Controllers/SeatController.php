<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Show;
use App\Models\ShowSeat;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seatRanges = Seat::selectRaw('venue_id, seat_type, MIN(seat_no) as start_seat, MAX(seat_no) as end_seat')  ->groupBy('venue_id','seat_type')  ->get();
        $venues = Venue::all();

    return view('seats.list', compact('seatRanges','venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venues = Venue::all();
        return view('seats.create', compact('venues'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'venue_id' => 'required|exists:venues,id'
    ]);

    $venue = Venue::findOrFail($request->venue_id);

    $totalSeats = $venue->capacity;
    $seatsPerRow = 10; // Change as needed

    $premium = (int)(($totalSeats * 10) / 100);
    $premiumCount = 0;

    for ($i = 0; $i < $totalSeats; $i++) {

        // Row index and seat position
        $rowIndex = floor($i / $seatsPerRow);
        $seatPosition = ($i % $seatsPerRow) + 1;

        // Generate row labels: A, B, ..., Z, AA, AB...
        $rowLabel = '';
        $n = $rowIndex;

        do {
            $rowLabel = chr(($n % 26) + 65) . $rowLabel;
            $n = intdiv($n, 26) - 1;
        } while ($n >= 0);

        $seatNo = $rowLabel . $seatPosition;

        // Seat type
        $seatType = ($premiumCount < $premium)
            ? 'Premium'
            : 'Standard';

        if ($premiumCount < $premium) {
            $premiumCount++;
        }

        Seat::create([
            'venue_id' => $venue->id,
            'seat_no' => $seatNo,
            'seat_type' => $seatType,
        ]);
    }

    return redirect()->route('admin.seats.index') ->with('success', 'Seats created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        return view('seats.edit',[
            'seat'=>$seat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'venue_id' => 'required',
            'seat_no' => 'required|integer',
            'seat_type' => 'required'
        ]);

        $seat->update([
            'venue_id' => $request->venue_id,
            'seat_no' => $request->seat_no,
            'seat_type' => $request->seat_type
        ]);
        return redirect()->route('admin.seat.index')->with('success', 'Seats updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Seat deleted successfully');
    }

    public function book(Request $request, $id){
        $seat = Seat::find($id);
        if($seat->status === 'Available'){
            $seat->status = 'Booked';
            $seat->save();

            return back()->with('success', 'Seat booked successfully.');
        }
        return back()->with('error', 'Seat is already booked.');
    }
    public function layout($id){
        $show = Show::findOrFail($id);
        $showSeats = ShowSeat::with('seat') ->where('show_id', $id) ->get();

        return view('seats.layout', compact('show', 'showSeats'));
    }
}
