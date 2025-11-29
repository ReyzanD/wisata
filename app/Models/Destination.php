<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations_232136';
    protected $fillable = ['name_232136', 'description_232136', 'category_id_232136', 'location_232136', 'image_232136', 'price_232136', 'daily_capacity_232136'];

    protected $casts = [
        'price_232136' => 'decimal:2',
        'daily_capacity_232136' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id_232136');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'destination_id_232136');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id_232136');
    }

    public function getImageUrl()
    {
        // Priority: destination main image > first gallery uploaded image > first gallery URL > null
        if ($this->image_232136) {
            return asset('storage/destinations/' . $this->image_232136);
        }
        
        $firstGallery = $this->galleries()->first();
        if ($firstGallery) {
            if ($firstGallery->image_232136) {
                return asset('storage/galleries/' . $firstGallery->image_232136);
            }
            if ($firstGallery->url_232136) {
                return $firstGallery->url_232136;
            }
        }
        
        return null;
    }

    public function getAverageRating()
    {
        $average = $this->reviews()->avg('rating_232136');
        return $average ? round($average, 1) : 0;
    }

    public function getReviewCount()
    {
        return $this->reviews()->count();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'destination_id_232136');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites_232136', 'destination_id_232136', 'user_id_232136')
                    ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'destination_id_232136');
    }

    /**
     * Get the number of people booked for a specific date
     */
    public function getBookedCapacityForDate($date)
    {
        return $this->bookings()
            ->where('visit_date_232136', $date)
            ->whereIn('status_232136', ['pending', 'confirmed'])
            ->sum('number_of_people_232136');
    }

    /**
     * Get available capacity for a specific date
     */
    public function getAvailableCapacityForDate($date)
    {
        $bookedCapacity = $this->getBookedCapacityForDate($date);
        return max(0, $this->daily_capacity_232136 - $bookedCapacity);
    }

    /**
     * Check if booking is possible for a specific date with number of people
     */
    public function canBookForDate($date, $numberOfPeople)
    {
        $availableCapacity = $this->getAvailableCapacityForDate($date);
        return $availableCapacity >= $numberOfPeople;
    }
}
