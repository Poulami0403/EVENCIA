<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
use App\Models\ShowSeat; 
use App\Models\Seat;


class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $shows = Show::with(['event', 'venue'])
                ->orderBy('created_at', 'desc')
                ->get();

    return view('shows.list', compact('shows'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $venues = Venue::all();
    $events = Event::all();

    $event = null;

    if ($request->filled('event_id')) {
        $event = Event::findOrFail($request->event_id);
    }

    return view('shows.create', compact('venues', 'events', 'event'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $show = Show::create([
            'event_id' => $request->event_id,
            'venue_id' => $request->venue_id,
            'show_date' => $request->show_date,
            'show_time' => $request->show_time,
            'ticket_price' => $request->ticket_price,
            'status' => $request->status
        ]);

        $seats = Seat::where('venue_id', $request->venue_id)->get();

// dd($request->venue_id, $seats->count());

        foreach ($seats as $seat) {
            ShowSeat::create([
                'show_id' => $show->id,
                'seat_id' => $seat->id,
                'status' => 1
            ]);
           
        }


        return redirect()->route('admin.shows.index')->with('success', 'Show created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Show $show)
    {
        //
    }

    public function seatLayout(Show $show)
{
    $showSeats = ShowSeat::with('seat')->where('show_id', $show->id)->get();

    return view('seats.layout', compact('showSeats'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show)
    {
        $venues = Venue::all();
        $events = Event::all();
         return view('shows.edit',[
            'show'=>$show
        ], compact('events','venues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Show $show)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'venue_id' => 'required|exists:venues,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'ticket_price' =>'required|numeric',
            'status' => 'required'
        ]);

        $show->update([
            'event_id' => $request->event_id,
            'venue_id' => $request->venue_id,
            'show_date' => $request->show_date,
            'show_time' => $request->show_time,
            'ticket_price'=>$request->ticket_price,
            'status'=>$request->status
        ]);

        return redirect()->route('admin.shows.index')->with('success', 'Show created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        ShowSeat::where('show_id', $show->id)->delete();
        $show->delete();
        return redirect()->route('admin.shows.index') ->with('success', 'Show deleted successfully');
    }

    public function eventShows($id)
    {
        $id = decrypt($id);
        $event = Event::findOrFail($id);
        $shows = Show::where('event_id', $event->id)
                    ->orderBy('show_date')
                    ->orderBy('show_time')
                    ->get();

        return view('shows.list', compact('event', 'shows'));
    }
}
