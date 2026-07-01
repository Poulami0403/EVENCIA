<?php

namespace App\Http\Controllers;

use App\Models\ShowSeat;
use Illuminate\Http\Request;
use App\Models\Seat;

class ShowSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showseats = ShowSeat::orderBy('created_at', 'DESC')->get();
        return view('showseats.list', compact('showseats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seatRanges = Seat::all();
        $shows = Show::all();
        return view('showseat.create', compact('seats','shows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'show_id' => 'required|exists:shows,id',
            'seat_id' => 'required|exists:seats,id',
            'status' => 'required'
        ]);

// dd($request->all());
        // save venue
        Show::create([
            'show_id' => $request->show_id,
            'seat_id' => $request->seat_id,
            'status'=>$request->status
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowSeat $showSeat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShowSeat $showSeat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShowSeat $showSeat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowSeat $showSeat)
    {
        //
    }
}
