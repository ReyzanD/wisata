<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name_232136' => 'Admin',
            'email_232136' => 'admin@wisata.com',
            'password_232136' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Run other seeders
        $this->call([
            CategorySeeder::class,
            DestinationSeeder::class,
            GallerySeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
