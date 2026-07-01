<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Show;

class Venue extends Model
{
    protected $fillable = [
    'venue_name',
    'location',
    'capacity',
    'status'
];
public function seat()
{
    return $this->hasmany(Seat::class);
}

public function show()
{
    return $this->hasmany(Show::class);
}
}
