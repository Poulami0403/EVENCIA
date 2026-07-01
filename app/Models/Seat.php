<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
    'venue_id',
    'seat_no',
    'seat_type'
];
public function venue()
{
    return $this->belongsTo(Venue::class);
}

public function showseat()
{
    return $this->hasmany(ShowSeat::class);
}
}
