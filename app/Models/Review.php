<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews_232136';
    protected $fillable = ['user_name_232136', 'user_id_232136', 'destination_id_232136', 'rating_232136', 'comment_232136'];
    
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id_232136');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_232136');
    }
}
