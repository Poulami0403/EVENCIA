<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Event;
use App\Models\Booking;
use App\Models\BookingSeat;

class DashboardController extends Controller
{
    public function index()
{
    


    $recentBookings = Booking::with(
        'show.event',
        'show.venue'
    )
    ->latest()
    ->take(5)
    ->get();

    $topVenues = Venue::withCount('show')
        ->orderByDesc('show_count')
        ->take(4)
        ->get();

    $totalRevenue = Booking::sum('total_amount');
    $ticketsSold = BookingSeat::count();
    $activeEvents = Event::count();

    return view(
        'admindashboard.index',
        compact(
            'recentBookings',
            'topVenues',
            'totalRevenue',
            'ticketsSold',
            'activeEvents'
        )
    );
}
    
}
