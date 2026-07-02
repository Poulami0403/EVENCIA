<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venue = Venue::orderBy('created_at', 'DESC')->get();
        return view('venues.list', compact('venue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venue_name' => 'required|max:255',
            'location' => 'required',
            'capacity' => 'required|integer',
            'status' => 'required'
        ]);


        // save venue
        Venue::create([
            'venue_name' => $request->venue_name,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'status' => $request->status
        ]);

        return redirect()->route('admin.venues.index')->with('success', 'venue created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($venue)
{
    try {
        $id = decrypt($venue);
        $venue = Venue::findOrFail($id);

        return view('venues.edit', compact('venue'));
    } catch (\Exception $e) {
        abort(404); // prevents payload crash
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $venue = venue::findorFail($id);
        $request->validate([
            'venue_name' => 'required|max:255',
            'location' => 'required',
            'capacity' => 'required|integer',
            'status' => 'required'
        ]);

        $venue->update([
            'venue_name' =>$request->venue_name,
            'location' =>$request->location,
            'capacity' =>$request->capacity,
            'status' =>$request->status
        ]);
        return redirect()->route('admin.venues.index')->with('success', 'venues updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('admin.venues.index')->with('success', 'Venue deleted successfully');

    }
}
