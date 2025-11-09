<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder{
    public function run(): void{
        $categories = [
            ['name_232136' => 'Pantai'],
            ['name_232136' => 'Gunung'],
            ['name_232136' => 'Candi'],
            ['name_232136' => 'Taman Nasional'],
            ['name_232136' => 'Danau'],
            ['name_232136' => 'Air Terjun'],
            ['name_232136' => 'Kota Bersejarah'],
            ['name_232136' => 'Pulau'],
        ];

        foreach ($categories as $category){
            Category::create($category);
        }
    }
}