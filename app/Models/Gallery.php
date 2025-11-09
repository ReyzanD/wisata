<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries_232136';
    protected $fillable = ['title_232136','url_232136', 'image_232136', 'destination_id_232136'];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id_232136');
    }

    public function getImageUrl()
    {
        // Priority: uploaded image > URL
        if ($this->image_232136) {
            return asset('storage/galleries/' . $this->image_232136);
        }
        
        if ($this->url_232136) {
            return $this->url_232136;
        }
        
        return null;
    }
}
