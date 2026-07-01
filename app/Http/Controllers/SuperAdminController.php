<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venue;
use App\Models\Event;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Show;


class SuperAdminController extends Controller
{
    public function index()
    {
        $totalAdmins = User::whereIn('role', ['admin', 'super_admin'])->count();

        $totalEvents = Event::count();

        $totalVenues = Venue::count();

        $totalBookings = Booking::count();

        $totalRevenue = Booking::sum('total_amount');

        $recentBookings = Booking::with(['user','show.event'])
                                ->latest()
                                ->take(4)
                                ->get();

        $topVenues = Venue::withCount('show')
        ->orderByDesc('show_count')
        ->take(4)
        ->get();

        $monthlyRevenue = Booking::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->pluck('revenue', 'month');

        $revenue = [];

        for ($i = 1; $i <= 12; $i++) {
            $revenue[] = $monthlyRevenue[$i] ?? 0;
        }

        $upcomingEvents = Show::with('event')
            ->whereDate('show_date', '>=', now())
            ->orderBy('show_date')
            ->take(5)
            ->get();

        $eventPerformance = Show::with(['event', 'bookings'])
        ->get()
        ->map(function ($show) {

        $ticketsSold = $show->bookings->count();

        $totalSeats = $show->venue->capacity;

        $remainingSeats = $ticketsSold + $totalSeats;

        $occupancy = $totalSeats > 0
            ? round(($ticketsSold / $totalSeats) * 100)
            : 0;

        $revenue = $show->bookings->sum('total_amount');

        return [
            'event' => $show->event->event_name,
            'tickets_sold' => $ticketsSold,
            'remaining' => $remainingSeats,
            'occupancy' => $occupancy,
            'revenue' => $revenue,
        ];
    });

        $logs = collect();

        // Latest Admin
        User::where('role', 'admin')
    ->latest()
    ->take(3)
    ->get()
    ->each(function ($admin) use ($logs) {

        $logs->push([
            'message' => "Admin {$admin->name} was created",
            'time' => $admin->created_at,
        ]);

    });

        // Latest Event
        Event::latest()->take(3)->get()->each(function ($event) use ($logs) {
            $logs->push([
                // 'icon' => '🎉',
                'message' => "Event '{$event->event_name}' was added",
                'time' => $event->created_at,
            ]);
        });

        // Latest Venue
        Venue::latest()->take(3)->get()->each(function ($venue) use ($logs) {
            $logs->push([
                // 'icon' => '🏢',
                'message' => "Venue '{$venue->venue_name}' was added",
                'time' => $venue->created_at,
            ]);
        });

        // Latest Booking
        Booking::latest()->take(3)->get()->each(function ($booking) use ($logs) {
            $logs->push([
                // 'icon' => '🎟️',
                'message' => "New booking created",
                'time' => $booking->created_at,
            ]);
        });

        $logs = $logs->sortByDesc('time')->take(8);

        return view('superadmin.dashboard', compact(
            'totalAdmins',
            'totalEvents',
            'totalVenues',
            'totalBookings',
            'totalRevenue',
            'recentBookings',
            'topVenues',
            'monthlyRevenue',
            'revenue',
            'upcomingEvents',
            'eventPerformance',
            'logs'
        ));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $events = Event::where('event_name', 'like', "%$search%") ->orWhere('category', 'like', "%{$search}%")->get();

        $venues = Venue::where('venue_name', 'like', "%$search%") ->orWhere('location', 'like', "%{$search}%")->get();

        $users = User::where('name', 'like', "%$search%") ->orWhere('email', 'like', "%{$search}%")->get();

        $bookings = Booking::where('customer_name', 'like', "%$search%") ->orWhere('customer_email', 'like', "%{$search}%")->get();


        return view('superadmin.search', compact('events', 'venues', 'users', 'bookings', 'search'));
    }

}
