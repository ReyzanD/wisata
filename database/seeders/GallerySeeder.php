<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder{
    public function run():void{
        $galleries = [
            // Pantai Kuta
            ['destination_id_232136' => 1, 'title_232136' => 'Sunset di Pantai Kuta', 'url_232136' => 'galleries/kuta-sunset.jpg'],
            ['destination_id_232136' => 1, 'title_232136' => 'Surfing di Kuta', 'url_232136' => 'galleries/kuta-surf.jpg'],
            
            // Gunung Bromo
            ['destination_id_232136' => 2, 'title_232136' => 'Sunrise Bromo', 'url_232136' => 'galleries/bromo-sunrise.jpg'],
            ['destination_id_232136' => 2, 'title_232136' => 'Lautan Pasir Bromo', 'url_232136' => 'galleries/bromo-sand.jpg'],
            
            // Borobudur
            ['destination_id_232136' => 3, 'title_232136' => 'Candi Borobudur', 'url_232136' => 'galleries/borobudur-temple.jpg'],
            ['destination_id_232136' => 3, 'title_232136' => 'Relief Borobudur', 'url_232136' => 'galleries/borobudur-relief.jpg'],
            
            // Raja Ampat
            ['destination_id_232136' => 4, 'title_232136' => 'Wayag Raja Ampat', 'url_232136' => 'galleries/rajaampat-wayag.jpg'],
            ['destination_id_232136' => 4, 'title_232136' => 'Underwater Raja Ampat', 'url_232136' => 'galleries/rajaampat-underwater.jpg'],
            
            // Danau Toba
            ['destination_id_232136' => 5, 'title_232136' => 'Danau Toba View', 'url_232136' => 'galleries/toba-lake.jpg'],
            ['destination_id_232136' => 5, 'title_232136' => 'Pulau Samosir', 'url_232136' => 'galleries/toba-samosir.jpg'],
            
            // Komodo
            ['destination_id_232136' => 6, 'title_232136' => 'Komodo Dragon', 'url_232136' => 'galleries/komodo-dragon.jpg'],
            ['destination_id_232136' => 6, 'title_232136' => 'Pink Beach', 'url_232136' => 'galleries/komodo-pink.jpg'],
            
            // Tanah Lot
            ['destination_id_232136' => 7, 'title_232136' => 'Pura Tanah Lot', 'url_232136' => 'galleries/tanahlot-temple.jpg'],
            
            // Kawah Ijen
            ['destination_id_232136' => 8, 'title_232136' => 'Blue Fire Ijen', 'url_232136' => 'galleries/ijen-bluefire.jpg'],
            ['destination_id_232136' => 8, 'title_232136' => 'Kawah Ijen', 'url_232136' => 'galleries/ijen-crater.jpg'],
            
            // Nusa Penida
            ['destination_id_232136' => 9, 'title_232136' => 'Kelingking Beach', 'url_232136' => 'galleries/penida-kelingking.jpg'],
            ['destination_id_232136' => 9, 'title_232136' => 'Crystal Bay', 'url_232136' => 'galleries/penida-crystal.jpg'],
            
            // Prambanan
            ['destination_id_232136' => 10, 'title_232136' => 'Candi Prambanan', 'url_232136' => 'galleries/prambanan-temple.jpg'],
            
            // Labuan Bajo
            ['destination_id_232136' => 11, 'title_232136' => 'Labuan Bajo Harbor', 'url_232136' => 'galleries/labuan-harbor.jpg'],
            
            // Belitung
            ['destination_id_232136' => 12, 'title_232136' => 'Tanjung Tinggi', 'url_232136' => 'galleries/belitung-beach.jpg'],
        ];
    
        foreach ($galleries as $gallery){
            Gallery::create($gallery);
        }
    }
}