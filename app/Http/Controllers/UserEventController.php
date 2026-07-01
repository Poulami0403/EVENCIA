<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Show;
use Carbon\Carbon;

class UserEventController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // Month and year
    $month = $request->get('month', Carbon::now()->month);
    $year = $request->get('year', Carbon::now()->year);

    $monthStart = Carbon::create($year, $month, 1);
    $monthEnd = $monthStart->copy()->endOfMonth();

    // Create dates of the month
    $availableDates = collect();

    for ($date = $monthStart->copy(); $date <= $monthEnd; $date->addDay()) {
        $availableDates->push($date->copy());
    }

    // Selected date
    $selectedDateStr = $request->get(
        'date',
        Carbon::today()->toDateString()
    );

    // Search + Date Filter
    $events = Event::with('shows.venue')

    ->when(!$search, function ($query) use ($selectedDateStr) {
        $query->whereHas('shows', function ($q) use ($selectedDateStr) {
            $q->whereDate('show_date', $selectedDateStr);
        });
    })

    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('event_name', 'LIKE', "%{$search}%")
              ->orWhere('category', 'LIKE', "%{$search}%")
              ->orWhereHas('shows.venue', function ($v) use ($search) {
                  $v->where('venue_name', 'LIKE', "%{$search}%");
              });
        });
    })

    ->latest()
    ->get();
    return view('events.index', compact(
        'events',
        'availableDates',
        'selectedDateStr',
        'monthStart'
    ));
}

public function details($id){
    $show = Show::with('event','venue')->findOrFail($id);
    $events = Event::all();

    return view('events.content', compact(
        'show','events'
    ));
}
}