<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder{
    public function run(): void{
        $reviews = [
            // Pantai Kuta
            [
                'destination_id_232136' => 1,
                'user_name_232136' => 'Budi Santoso',
                'rating_232136' => 5,
                'comment_232136' => 'Pantai yang sangat indah! Sunset-nya luar biasa. Ombaknya juga bagus untuk belajar surfing. Highly recommended!',
            ],
            [
                'destination_id_232136' => 1,
                'user_name_232136' => 'Sarah Johnson',
                'rating_232136' => 4,
                'comment_232136' => 'Beautiful beach with great waves. A bit crowded during peak season but still worth visiting.',
            ],
            
            // Gunung Bromo
            [
                'destination_id_232136' => 2,
                'user_name_232136' => 'Ahmad Rizki',
                'rating_232136' => 5,
                'comment_232136' => 'Pengalaman yang tidak terlupakan! Sunrise di Bromo benar-benar spektakuler. Persiapkan jaket tebal karena sangat dingin di pagi hari.',
            ],
            [
                'destination_id_232136' => 2,
                'user_name_232136' => 'Lisa Wong',
                'rating_232136' => 5,
                'comment_232136' => 'Absolutely breathtaking! The sunrise view is worth the early morning wake up. The sea of sand is magnificent.',
            ],
            
            // Borobudur
            [
                'destination_id_232136' => 3,
                'user_name_232136' => 'Dewi Lestari',
                'rating_232136' => 5,
                'comment_232136' => 'Candi yang megah dan penuh sejarah. Relief-reliefnya sangat detail dan indah. Datang pagi hari untuk menghindari panas dan keramaian.',
            ],
            [
                'destination_id_232136' => 3,
                'user_name_232136' => 'Michael Chen',
                'rating_232136' => 5,
                'comment_232136' => 'A UNESCO World Heritage site that truly deserves its status. The architecture is incredible and the sunrise tour is magical.',
            ],
            
            // Raja Ampat
            [
                'destination_id_232136' => 4,
                'user_name_232136' => 'Rina Kusuma',
                'rating_232136' => 5,
                'comment_232136' => 'Surga dunia! Keindahan bawah lautnya tidak ada duanya. Snorkeling dan diving di sini adalah pengalaman yang luar biasa.',
            ],
            [
                'destination_id_232136' => 4,
                'user_name_232136' => 'David Miller',
                'rating_232136' => 5,
                'comment_232136' => 'The most beautiful place I have ever visited. The marine biodiversity is unmatched. A must-visit for divers!',
            ],
            
            // Danau Toba
            [
                'destination_id_232136' => 5,
                'user_name_232136' => 'Siti Nurhaliza',
                'rating_232136' => 4,
                'comment_232136' => 'Danau yang sangat luas dan indah. Pulau Samosir sangat menarik dengan budaya Bataknya. Udaranya sejuk dan menyegarkan.',
            ],
            [
                'destination_id_232136' => 5,
                'user_name_232136' => 'John Anderson',
                'rating_232136' => 4,
                'comment_232136' => 'Beautiful lake with stunning views. Samosir Island is a great place to experience Batak culture.',
            ],
            
            // Komodo
            [
                'destination_id_232136' => 6,
                'user_name_232136' => 'Andi Wijaya',
                'rating_232136' => 5,
                'comment_232136' => 'Melihat komodo di habitat aslinya sangat menakjubkan! Pink Beach-nya juga cantik sekali. Jangan lupa snorkeling!',
            ],
            [
                'destination_id_232136' => 6,
                'user_name_232136' => 'Emma Watson',
                'rating_232136' => 5,
                'comment_232136' => 'Seeing Komodo dragons in the wild was incredible! The pink beach is unique and the snorkeling is fantastic.',
            ],
            
            // Tanah Lot
            [
                'destination_id_232136' => 7,
                'user_name_232136' => 'Made Suryawan',
                'rating_232136' => 5,
                'comment_232136' => 'Pura yang sangat indah dengan latar belakang laut. Sunset di sini sangat romantis. Tempat yang wajib dikunjungi di Bali.',
            ],
            
            // Kawah Ijen
            [
                'destination_id_232136' => 8,
                'user_name_232136' => 'Rudi Hartono',
                'rating_232136' => 5,
                'comment_232136' => 'Blue fire-nya benar-benar menakjubkan! Pendakiannya cukup berat tapi sangat worth it. Jangan lupa bawa masker karena bau belerangnya kuat.',
            ],
            [
                'destination_id_232136' => 8,
                'user_name_232136' => 'Sophie Martin',
                'rating_232136' => 5,
                'comment_232136' => 'The blue fire is a once in a lifetime experience! The hike is challenging but absolutely worth it.',
            ],
            
            // Nusa Penida
            [
                'destination_id_232136' => 9,
                'user_name_232136' => 'Putu Ayu',
                'rating_232136' => 5,
                'comment_232136' => 'Kelingking Beach adalah spot foto terbaik! Pemandangannya sangat dramatis. Crystal Bay juga bagus untuk snorkeling.',
            ],
            [
                'destination_id_232136' => 9,
                'user_name_232136' => 'James Wilson',
                'rating_232136' => 4,
                'comment_232136' => 'Stunning cliffs and beautiful beaches. Kelingking Beach is iconic. The roads are rough but the views are worth it.',
            ],
            
            // Prambanan
            [
                'destination_id_232136' => 10,
                'user_name_232136' => 'Dian Sastro',
                'rating_232136' => 5,
                'comment_232136' => 'Candi Hindu yang megah! Arsitekturnya sangat detail dan indah. Pertunjukan Ramayana di malam hari juga sangat menarik.',
            ],
            
            // Labuan Bajo
            [
                'destination_id_232136' => 11,
                'user_name_232136' => 'Yoga Pratama',
                'rating_232136' => 5,
                'comment_232136' => 'Kota yang sempurna untuk island hopping! Pulau-pulau di sekitarnya sangat cantik. Sunset dari Puncak Cinta luar biasa.',
            ],
            
            // Belitung
            [
                'destination_id_232136' => 12,
                'user_name_232136' => 'Nina Sari',
                'rating_232136' => 5,
                'comment_232136' => 'Pantai-pantainya eksotis dengan batu granit yang unik! Air lautnya jernih sekali. Island hopping-nya seru banget!',
            ],
        ];
        foreach ($reviews as $review){
            Review::create($review);
        }
    }
}