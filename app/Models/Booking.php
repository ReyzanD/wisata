<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings_232136';
    
    protected $fillable = [
        'user_id_232136',
        'destination_id_232136',
        'booking_code_232136',
        'visit_date_232136',
        'number_of_people_232136',
        'special_requests_232136',
        'status_232136',
        'total_price_232136',
    ];

    protected $casts = [
        'visit_date_232136' => 'date',
        'total_price_232136' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_232136');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id_232136');
    }

    public static function generateBookingCode()
    {
        do {
            $code = 'BK' . strtoupper(substr(uniqid(), -8));
        } while (self::where('booking_code_232136', $code)->exists());
        
        return $code;
    }

    public function getStatusBadgeClass()
    {
        return match($this->status_232136) {
            'confirmed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }

    public function getStatusText()
    {
        return match($this->status_232136) {
            'confirmed' => 'Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            default => 'Menunggu',
        };
    }
}
