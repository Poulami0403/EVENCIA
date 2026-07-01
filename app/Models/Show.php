<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = [
        'event_id',
        'venue_id',
        'show_date',
        'show_time',
        'ticket_price',
        'status'
    ];
    public function venue(){
        return $this->belongsTo(Venue::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function showseat(){
        return $this->hasmany(ShowSeat::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
