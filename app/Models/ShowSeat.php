<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowSeat extends Model
{
    protected $fillable = [
        'show_id',
        'seat_id',
        'status'
    ];
    public function show(){
        return $this->belongsTo(Show::class);
    }

    public function seat(){
        return $this->belongsTo(Seat::class);
    }
    public function bookingSeat(){
        return $this->hasOne(BookingSeat::class);
    }
}
