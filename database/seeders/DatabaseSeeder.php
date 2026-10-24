<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Destinasi Populer Nusantara
        $destinations = [
            [
                'name' => 'Kepulauan Wayag, Raja Ampat',
                'slug' => 'kepulauan-wayag-raja-ampat',
                'region' => 'Papua & Maluku',
                'location' => 'Raja Ampat, Papua Barat Daya',
                'category' => 'Pantai',
                'rating' => 4.95,
                'reviews_count' => 428,
                'price' => 6850000,
                'duration' => '4 Hari 3 Malam',
                'best_time' => 'Oktober – April',
                'image' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=900&q=80',
                'description' => 'Gugusan pulau karst ikonik di tengah perairan biru kehijauan yang jernih. Raja Ampat merupakan rumah bagi 75% spesies terumbu karang dunia, menjadikannya surga penyelaman dan snorkeling nomor satu di bumi.',
                'highlights' => [
                    'Trekking Puncak Karst Wayag & Piaynemo',
                    'Snorkeling bersama Pari Manta di Manta Sandy',
                    'Mengunjungi Desa Wisata Arborek',
                    'Sunset di Pasir Timbul Mansuar',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Taman Nasional Gunung Bromo',
                'slug' => 'taman-nasional-gunung-bromo',
                'region' => 'Jawa',
                'location' => 'Probolinggo, Jawa Timur',
                'category' => 'Pegunungan',
                'rating' => 4.90,
                'reviews_count' => 812,
                'price' => 1450000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Mei – Oktober',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=900&q=80',
                'description' => 'Saksikan kemegahan matahari terbit keemasan dari Bukit Penanjakan dengan latar Gunung Bromo, Gunung Batok, dan Gunung Semeru yang diselimuti lautan kabut pagi yang magis.',
                'highlights' => [
                    'Golden Sunrise di Bukit Kingkong / Penanjakan',
                    'Eksplorasi Lautan Pasir Berbisik dengan Jeep 4x4',
                    'Mendaki Kawah Aktif Gunung Bromo',
                    'Piknik pagi di Padang Savana Bukit Teletubbies',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Pulau Padar & Taman Nasional Komodo',
                'slug' => 'pulau-padar-taman-nasional-komodo',
                'region' => 'Bali & Nusa Tenggara',
                'location' => 'Labuan Bajo, Nusa Tenggara Timur',
                'category' => 'Alam',
                'rating' => 4.94,
                'reviews_count' => 695,
                'price' => 4250000,
                'duration' => '3 Hari 2 Malam',
                'best_time' => 'April – November',
                'image' => 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?auto=format&fit=crop&w=900&q=80',
                'description' => 'Berlayar dengan kapal Phinisi kayu tradisional melintasi kepulauan eksotis Labuan Bajo. Temui kadal purba raksasa Komodo di habitat aslinya dan nikmati panorama tiga teluk melengkung dari puncak Pulau Padar.',
                'highlights' => [
                    'Sailing Liveaboard di atas Kapal Phinisi',
                    'Trekking Sunrise Pulau Padar',
                    'Melihat Komodo didampingi Ranger Resmi',
                    'Bersantai di Pink Beach yang langka',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Candi Agung Borobudur & Bukit Rhema',
                'slug' => 'candi-agung-borobudur-bukit-rhema',
                'region' => 'Jawa',
                'location' => 'Magelang, Jawa Tengah',
                'category' => 'Budaya',
                'rating' => 4.88,
                'reviews_count' => 950,
                'price' => 1250000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Sepanjang Tahun',
                'image' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=900&q=80',
                'description' => 'Mahakarya arsitektur Buddha terbesar di dunia dari abad ke-8. Nikmati tur sejarah mendalam membaca relief kuno, dilanjutkan dengan tur sepeda pedesaan dan lokakarya batik serta gerabah di Desa Karanganyar.',
                'highlights' => [
                    'Akses naik struktur Candi Borobudur bersama kurator',
                    'Sunrise di Punthuk Setumbu',
                    'Berkeliling desa wisata dengan VW Safari klasik',
                    'Kuliner tradisional Mangut Beong khas Magelang',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Tebing Kelingking, Nusa Penida',
                'slug' => 'tebing-kelingking-nusa-penida',
                'region' => 'Bali & Nusa Tenggara',
                'location' => 'Klungkung, Bali',
                'category' => 'Pantai',
                'rating' => 4.91,
                'reviews_count' => 1120,
                'price' => 1850000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'April – Oktober',
                'image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=900&q=80',
                'description' => 'Formasi tebing kapur megah menyerupai T-Rex yang menjorok ke samudra biru tua. Nusa Penida menawarkan kombinasi dramatis antara tebing karang terjal, laguna alami Angel\'s Billabong, dan pantai pasir putih.',
                'highlights' => [
                    'Spot panorama Kelingking Beach & Broken Beach',
                    'Berenang bersama Manta di Crystal Bay',
                    'Menginap di Eco-Resort tepi pantai',
                    'Kunjungan ke Rumah Pohon Molenteng (Atuh Beach)',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Kaldera Danau Toba & Pulau Samosir',
                'slug' => 'kaldera-danau-toba-pulau-samosir',
                'region' => 'Sumatera',
                'location' => 'Samosir, Sumatera Utara',
                'category' => 'Pegunungan',
                'rating' => 4.86,
                'reviews_count' => 340,
                'price' => 2650000,
                'duration' => '3 Hari 2 Malam',
                'best_time' => 'Mei – September',
                'image' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=900&q=80',
                'description' => 'Danau vulkanik terbesar di dunia yang tenang dikelilingi perbukitan hijau pinus. Selami kekayaan budaya suku Batak Toba di Pulau Samosir, pertunjukan tari Sigale-gale, serta kemegahan Air Terjun Sipiso-piso.',
                'highlights' => [
                    'Menyeberang ke Pulau Samosir & Desa Huta Siallagan',
                    'Panorama Bukit Holbung & Menara Tele',
                    'Kunjungan ke Air Terjun tertinggi Sipiso-piso',
                    'Mencicipi Kopi Lintong & kuliner khas Toba',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Desa Adat Kete Kesu, Tana Toraja',
                'slug' => 'desa-adat-kete-kesu-tana-toraja',
                'region' => 'Kalimantan & Sulawesi',
                'location' => 'Toraja Utara, Sulawesi Selatan',
                'category' => 'Budaya',
                'rating' => 4.89,
                'reviews_count' => 275,
                'price' => 3450000,
                'duration' => '4 Hari 3 Malam',
                'best_time' => 'Juni – Oktober',
                'image' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=900&q=80',
                'description' => 'Jelajahi dataran tinggi mistis Sulawesi dengan deretan rumah adat Tongkonan beratap melengkung perahu. Pelajari filosofi kehidupan leluhur Toraja dan nikmati negeri di atas awan Lolai.',
                'highlights' => [
                    'Arsitektur Tongkonan di Desa Kete Kesu',
                    'Lautan awan pagi di Puncak Lolai',
                    'Situs pemakaman batu tebing Londa',
                    'Tur perkebunan Kopi Arabika Toraja',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Fenomena Api Biru Kawah Ijen',
                'slug' => 'fenomena-api-biru-kawah-ijen',
                'region' => 'Jawa',
                'location' => 'Banyuwangi, Jawa Timur',
                'category' => 'Alam',
                'rating' => 4.92,
                'reviews_count' => 530,
                'price' => 1350000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Mei – Oktober',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80',
                'description' => 'Pendakian malam menuju salah satu dari dua tempat di dunia yang memiliki fenomena api biru (Blue Fire) alami, diikuti pemandangan danau kawah asam berwarna toska saat matahari terbit.',
                'highlights' => [
                    'Pendakian dini hari menyaksikan Blue Fire',
                    'Panorama kaldera toska Kawah Ijen saat sunrise',
                    'Eksplorasi Hutan Djawatan Benculuk yang magis',
                    'Peralatan masker gas & pemandu lokal lengkap',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Kepulauan Derawan & Danau Kakaban',
                'slug' => 'kepulauan-derawan-danau-kakaban',
                'region' => 'Kalimantan & Sulawesi',
                'location' => 'Berau, Kalimantan Timur',
                'category' => 'Pantai',
                'rating' => 4.93,
                'reviews_count' => 310,
                'price' => 4550000,
                'duration' => '4 Hari 3 Malam',
                'best_time' => 'Maret – Oktober',
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=900&q=80',
                'description' => 'Surga tersembunyi di Kalimantan Timur di mana Anda dapat berenang bersama ribuan ubur-ubur tanpa sengat di Danau purba Kakaban, menyapa penyu hijau di Pulau Sangalaki, dan bersantai di resort atas air.',
                'highlights' => [
                    'Berenang bersama ubur-ubur jinak di Danau Kakaban',
                    'Konservasi penyu hijau di Pulau Sangalaki',
                    'Laguna rahasia Gua Haji Mangku di Maratua',
                    'Menginap di Water Villa atas laut jernih',
                ],
                'is_featured' => true,
            ],
        ];

        foreach ($destinations as $dest) {
            Destination::updateOrCreate(['slug' => $dest['slug']], $dest);
        }

        // 2. Paket Wisata Unggulan All-Inclusive
        $packages = [
            [
                'name' => 'Paket Eksplorasi Labuan Bajo Phinisi',
                'slug' => 'paket-eksplorasi-labuan-bajo-phinisi',
                'badge' => 'Terlaris #1',
                'duration' => '3 Hari 2 Malam',
                'hotel' => 'Kapal Phinisi Deluxe Cabin AC',
                'price' => 4450000,
                'original_price' => 5200000,
                'facilities' => [
                    'Antar-jemput Bandara Komodo PP',
                    'Menginap 2 malam di Phinisi Kabin Privat',
                    'Makan 7x (Fullboard + Snack Sore & Kelapa Muda)',
                    'Dokumentasi Kamera Mirrorless, GoPro & Drone',
                    'Alat Snorkeling Lengkap & Life Jacket',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Magis Jawa Timur (Bromo - Ijen - Tumpak Sewu)',
                'slug' => 'paket-magis-jawa-timur',
                'badge' => 'Pilihan Petualang',
                'duration' => '4 Hari 3 Malam',
                'hotel' => 'Hotel Bintang 4 & Glamping Resort',
                'price' => 2950000,
                'original_price' => 3500000,
                'facilities' => [
                    'Transportasi Privat Innova Zenix selama tur',
                    'Sewa Jeep 4x4 Bromo & Masker Gas Kawah Ijen',
                    'Akomodasi 3 malam termasuk sarapan',
                    'Tiket masuk seluruh kawasan Taman Nasional',
                    'Pemandu wisata lokal & fotografer pendamping',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Royal Honeymoon & Budaya Bali - Nusa Penida',
                'slug' => 'paket-royal-honeymoon-bali-nusa-penida',
                'badge' => 'Eksklusif',
                'duration' => '5 Hari 4 Malam',
                'hotel' => 'Private Pool Villa Ubud & Seminyak',
                'price' => 5750000,
                'original_price' => 6600000,
                'facilities' => [
                    '2 Malam Private Pool Villa Ubud + 2 Malam Seminyak',
                    'Fast Boat PP ke Pulau Nusa Penida + Mobil Privat',
                    'Romantic Candle Light Dinner di tepi pantai Jimbaran',
                    'Paket Spa Tradisional Bali 120 Menit',
                    'Semua tiket masuk objek wisata & parkir',
                ],
                'is_featured' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            TourPackage::updateOrCreate(['slug' => $pkg['slug']], $pkg);
        }

        // 3. Galeri Nusantara
        $gallery = [
            [
                'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=900&q=80',
                'title' => 'Pura Ulun Danu Bratan, Bedugul',
                'sub_title' => 'Tabanan, Bali • Diambil saat matahari terbit',
                'location' => 'Bali',
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=900&q=80',
                'title' => 'Gugusan Karst Piaynemo',
                'sub_title' => 'Raja Ampat, Papua Barat Daya • Dokumentasi Drone',
                'location' => 'Papua Barat Daya',
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=900&q=80',
                'title' => 'Kabut Pagi Kaldera Tengger',
                'sub_title' => 'Taman Nasional Bromo Tengger Semeru, Jawa Timur',
                'location' => 'Jawa Timur',
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?auto=format&fit=crop&w=900&q=80',
                'title' => 'Puncak Bukit Pulau Padar',
                'sub_title' => 'Taman Nasional Komodo, Nusa Tenggara Timur',
                'location' => 'Nusa Tenggara Timur',
            ],
        ];

        foreach ($gallery as $item) {
            GalleryItem::updateOrCreate(['title' => $item['title']], $item);
        }

        // 4. Testimoni Wisatawan
        $testimonials = [
            [
                'name' => 'Nadia Putri Larasati',
                'role' => 'Arsitek • Jakarta',
                'trip' => 'Sailing Labuan Bajo 3H2M',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'comment' => 'Pengalaman berlayar di Labuan Bajo bersama NusantaraWander benar-benar melampaui ekspektasi! Kapal Phinisi sangat bersih, makanan di atas kapal lezat, dan hasil video drone dari tim fotografer luar biasa sinematik.',
                'rating' => 5,
            ],
            [
                'name' => 'Reza Mahendra & Keluarga',
                'role' => 'Pengusaha • Surabaya',
                'trip' => 'Eksplorasi Raja Ampat 4H3M',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'comment' => 'Membawa orang tua dan anak-anak ke Raja Ampat tadinya terasa rumit, tapi tim lokal NusantaraWander mengatur semuanya dengan sangat rapi dan aman. Tidak ada biaya tambahan mendadak sama sekali.',
                'rating' => 5,
            ],
            [
                'name' => 'Clara Wijaya',
                'role' => 'Travel Blogger • Bandung',
                'trip' => 'Bromo & Kawah Ijen Private Trip',
                'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80',
                'comment' => 'Pemandu wisatanya sangat berpengetahuan luas dan tahu spot sunrise Bromo yang sepi dari kerumunan turis. Perjalanan terasa sangat intim dan berkesan. Pasti akan pesan lagi untuk trip ke Derawan!',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }

        // 5. Sample Booking
        Booking::updateOrCreate(
            ['booking_code' => 'NW-88291'],
            [
                'item_name' => 'Paket Eksplorasi Labuan Bajo Phinisi',
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567890',
                'customer_email' => 'budi.santoso@example.com',
                'travel_date' => now()->addDays(7)->format('Y-m-d'),
                'pax' => 2,
                'addon_drone' => true,
                'addon_vip' => false,
                'promo_code' => 'PESONAID',
                'discount_amount' => 1402500,
                'total_price' => 7947500,
                'status' => 'confirmed',
                'notes' => 'Pemesanan simulasi pertama',
            ]
        );
    }
}
