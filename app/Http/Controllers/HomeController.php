<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Event;
use App\Models\Venue;
use App\Models\Booking;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Show::with(['event', 'venue'])
        ->whereHas('event', function ($q) {
            $q->where('category', 'Movie');
        })
        ->latest()
        ->take(10)
        ->get();

        $concerts = Show::with(['event', 'venue'])
        ->whereHas('event', function ($q) {
            $q->where('Category', 'Concert');
        })
        ->latest()
        ->take(10)
        ->get();
    
        $featuredShows = Show::with(['event','venue'])
                                ->latest()
                                ->take(6)
                                ->get();

        $topCategories = [
            [
                'name' => 'Concerts',
                'image' => asset('images/concert.jpg'),
                'badge' => 'Popular'
            ],
            [
                'name' => 'Theatre',
                'image' => asset('images/theatre.jpg'),
                'badge' => 'Trending'
            ]
        ];

        $bottomCategories = [
            [
                'name' => 'Sports',
                'image' => asset('images/sports.jpg'),
                'badge' => 'New'
            ],
            [
                'name' => 'Comedy',
                'image' => asset('images/comedy.jpg'),
                'badge' => 'Live'
            ],
            [
                'name' => 'Workshops',
                'image' => asset('images/workshop.jpg'),
                'badge' => 'Featured'
            ]
        ];
        $events = Event::all();

        return view('home.index', compact(
            'featuredShows',
            'topCategories',
            'bottomCategories',
            'events',
            'movies',
            'concerts'
        ));
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
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
