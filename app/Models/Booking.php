<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke User (Employee).
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Relasi ke Service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function review()
    {
        return $this->hasOne(Review::class, 'booking_id', 'id');
    }
}
