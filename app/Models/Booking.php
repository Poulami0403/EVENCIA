<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'show_id',
        'customer_name',
        'customer_email',
        'total_amount',
        'status'
    ];
    public function show(){
        return $this->belongsTo(Show::class);
    }

    public function bookingSeats(){
        return $this->hasMany(BookingSeat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
