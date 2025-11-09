<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories_232136';
    protected $fillable = ['name_232136'];

    public function destinations()
    {
        return $this->hasMany(Destination::class, 'category_id_232136');
    }
}
