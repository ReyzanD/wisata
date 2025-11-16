<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites_232136';
    
    protected $fillable = [
        'user_id_232136',
        'destination_id_232136',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_232136');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id_232136');
    }
}
