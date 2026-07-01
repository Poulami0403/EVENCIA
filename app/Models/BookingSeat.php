<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSeat extends Model
{
    protected $fillable = [
        'booking_id',
        'show_id',
        'show_seat_id',
        'seat_id'
    ];
    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function showSeat(){
        return $this->belongsTo(ShowSeat::class);
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
