<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder{
    public function run(): void{
        $destinations = [
            [
                'name_232136' => 'Pantai Kuta',
                'description_232136' => 'Pantai Kuta adalah salah satu pantai paling terkenal di Bali. Dengan pasir putihnya yang lembut dan ombak yang sempurna untuk berselancar, pantai ini menjadi destinasi favorit wisatawan lokal dan mancanegara. Matahari terbenam di Pantai Kuta sangat memukau dan menjadi momen yang tidak boleh dilewatkan.',
                'location_232136' => 'Kuta, Bali',
                'category_id_232136' => 1,
            ],
            [
                'name_232136' => 'Gunung Bromo',
                'description_232136' => 'Gunung Bromo adalah gunung berapi aktif yang terletak di Jawa Timur. Pemandangan matahari terbit dari puncak Bromo sangat spektakuler dengan lautan pasir dan kawah yang masih aktif. Suhu di pagi hari sangat dingin, menciptakan pengalaman yang tak terlupakan bagi para pendaki.',
                'location_232136' => 'Probolinggo, Jawa Timur',
                'category_id_232136' => 2,
            ],
            [
                'name_232136' => 'Candi Borobudur',
                'description_232136' => 'Candi Borobudur adalah candi Buddha terbesar di dunia dan merupakan warisan dunia UNESCO. Dibangun pada abad ke-9, candi ini memiliki arsitektur yang megah dengan relief yang menceritakan kisah perjalanan Buddha. Pemandangan matahari terbit dari puncak candi sangat menakjubkan.',
                'location_232136' => 'Magelang, Jawa Tengah',
                'category_id_232136' => 3,
            ],
            [
                'name_232136' => 'Raja Ampat',
                'description_232136' => 'Raja Ampat adalah surga bagi para penyelam dengan keanekaragaman hayati laut terkaya di dunia. Kepulauan ini memiliki lebih dari 1,500 pulau kecil dengan pantai berpasir putih, laguna tersembunyi, dan terumbu karang yang menakjubkan. Pemandangan karst yang menjulang dari laut biru adalah ikon Raja Ampat.',
                'location_232136' => 'Papua Barat',
                'category_id_232136' => 8,
            ],
            [
                'name_232136' => 'Danau Toba',
                'description_232136' => 'Danau Toba adalah danau vulkanik terbesar di Indonesia dan Asia Tenggara. Di tengah danau terdapat Pulau Samosir yang menjadi rumah bagi suku Batak. Udara sejuk, pemandangan indah, dan budaya Batak yang kaya membuat Danau Toba menjadi destinasi wisata yang sempurna.',
                'location_232136' => 'Sumatera Utara',
                'category_id_232136' => 5,
            ],
            [
                'name_232136' => 'Taman Nasional Komodo',
                'description_232136' => 'Taman Nasional Komodo adalah habitat asli komodo, kadal terbesar di dunia. Selain komodo, taman nasional ini menawarkan pantai pink yang langka, snorkeling di perairan jernih, dan trekking di bukit savana. Pemandangan sunset dari Pulau Padar sangat ikonik.',
                'location_232136' => 'Nusa Tenggara Timur',
                'category_id_232136' => 4,
            ],
            [
                'name_232136' => 'Tanah Lot',
                'description_232136' => 'Tanah Lot adalah pura laut yang terletak di atas batu karang besar di tepi pantai. Pura ini menjadi salah satu ikon Bali dengan pemandangan sunset yang memukau. Saat air laut surut, pengunjung dapat berjalan menuju pura dan melihat ular suci yang dipercaya menjaga pura.',
                'location_232136' => 'Tabanan, Bali',
                'category_id_232136' => 1,
            ],
            [
                'name_232136' => 'Kawah Ijen',
                'description_232136' => 'Kawah Ijen terkenal dengan fenomena blue fire yang langka, hanya ada dua di dunia. Pendakian dimulai tengah malam untuk menyaksikan api biru yang menakjubkan. Danau kawah berwarna tosca dengan kandungan belerang tinggi menciptakan pemandangan yang surreal.',
                'location_232136' => 'Banyuwangi, Jawa Timur',
                'category_id_232136' => 2,
            ],
            [
                'name_232136' => 'Nusa Penida',
                'description_232136' => 'Nusa Penida adalah pulau kecil di sebelah tenggara Bali dengan tebing-tebing dramatis dan pantai tersembunyi. Kelingking Beach dengan tebing berbentuk T-Rex adalah spot foto paling ikonik. Crystal Bay dan Atuh Beach menawarkan pemandangan laut yang jernih dan pasir putih.',
                'location_232136' => 'Klungkung, Bali',
                'category_id_232136' => 8,
            ],
            [
                'name_232136' => 'Candi Prambanan',
                'description_232136' => 'Candi Prambanan adalah kompleks candi Hindu terbesar di Indonesia yang dibangun pada abad ke-9. Candi ini didedikasikan untuk Trimurti: Brahma, Wisnu, dan Siwa. Arsitektur candi yang menjulang tinggi dengan relief Ramayana yang indah menjadikannya warisan dunia UNESCO.',
                'location_232136' => 'Sleman, Yogyakarta',
                'category_id_232136' => 3,
            ],
            [
                'name_232136' => 'Labuan Bajo',
                'description_232136' => 'Labuan Bajo adalah gerbang menuju Taman Nasional Komodo dan kepulauan eksotis di sekitarnya. Kota pelabuhan ini menawarkan island hopping ke pulau-pulau cantik, snorkeling dengan manta ray, dan sunset cruise. Puncak Cinta dan Bukit Sylvia menawarkan pemandangan teluk yang menakjubkan.',
                'location_232136' => 'Flores, Nusa Tenggara Timur',
                'category_id_232136' => 7,
            ],
            [
                'name_232136' => 'Pulau Belitung',
                'description_232136' => 'Pulau Belitung terkenal dengan pantai-pantai eksotis dengan batu granit raksasa yang tersebar di sepanjang pantai. Tanjung Tinggi dan Tanjung Kelayang adalah pantai paling terkenal. Air laut yang jernih berwarna tosca dan pulau-pulau kecil di sekitarnya sempurna untuk island hopping.',
                'location_232136' => 'Bangka Belitung',
                'category_id_232136' => 8,
            ],
        ];

        foreach ($destinations as $destination){
            Destination::create($destination);
        }
    }
}