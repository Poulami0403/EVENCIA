<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Venue;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'DESC')->get();

        return view('events.list', compact('events'));
    }

    
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|max:255',
            'event_details' => 'required',
            'category' => 'required',
            'duration' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required'
        ]);

        // upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        // save event
        Event::create([
            'event_name' => $request->event_name,
            'event_details' => $request->event_details,
            'category' => $request->category,
            'duration' => $request->duration,
            'image' => $imageName,
            'status' => $request->status
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully');
    }
    public function edit($id){
        $event = Event::findorFail($id);
        return view('events.edit',[
            'event'=>$event
        ]);
    }
    public function update(Request $request, Event $event)
{
    $request->validate([
        'event_name' => 'required|max:255',
        'event_details' => 'required',
        'category' => 'required',
        'duration' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'status' => 'required'
    ]);

    $imageName = $event->image;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(
            public_path('uploads'),
            $imageName
        );
    }

    $event->update([
        'event_name' => $request->event_name,
        'event_details' => $request->event_details,
        'category' => $request->category,
        'duration' => $request->duration,
        'image' => $imageName,
        'status' => $request->status,
    ]);

    return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully');
}
    public function destroy($id){

    $event = Event::findorFail($id);
    //     if (File::exists(public_path('uploads' . $event->image))) {
    //     File::delete(public_path('uploads' . $event->image));
    // }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'event deleted successfully');
    }

    //user side

    public function userIndex()
{
    $events = Event::with('shows.venue')->orderBy('created_at', 'DESC')->get();
    return view('events.index', compact('events'));
}
}