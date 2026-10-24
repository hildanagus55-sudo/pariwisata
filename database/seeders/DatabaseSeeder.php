<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with natural, human-curated tourism data.
     */
    public function run(): void
    {
        // 1. Destinasi Populer Nusantara (Kurasi Natural & Personal)
        $destinations = [
            [
                'name' => 'Wayag & Piaynemo, Raja Ampat',
                'slug' => 'wayag-piaynemo-raja-ampat',
                'region' => 'Papua & Maluku',
                'location' => 'Raja Ampat, Papua Barat Daya',
                'category' => 'Pantai',
                'rating' => 4.96,
                'reviews_count' => 432,
                'price' => 6850000,
                'duration' => '4 Hari 3 Malam',
                'best_time' => 'Oktober – April (Ombak tenang)',
                'image' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Melihat langsung gugusan bukit karst di atas gradasi air laut toska adalah pengalaman yang hening sekaligus magis. Anda akan diajak trekking santai ke puncak Piaynemo, snorkeling bareng pari manta di Manta Sandy, dan singgah makan siang di rumah warga Desa Arborek.',
                'highlights' => [
                    'Trekking puncak karst Piaynemo saat pagi hari',
                    'Snorkeling di terumbu karang hidup Manta Sandy',
                    'Makan ikan bakar segar khas warga Arborek',
                    'Menikmati senja tenang di Pasir Timbul Mansuar',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Kaldera Bromo & Sabana Teletubbies',
                'slug' => 'kaldera-bromo-sabana-teletubbies',
                'region' => 'Jawa',
                'location' => 'Taman Nasional Bromo Tengger Semeru, Jawa Timur',
                'category' => 'Pegunungan',
                'rating' => 4.91,
                'reviews_count' => 840,
                'price' => 1450000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Mei – Oktober (Langit cerah)',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Berangkat dini hari menembus dingin dengan Jeep 4x4 lokal bersama sopir warga Tengger asli. Dari Bukit Kingkong, matahari muncul pelan-pelan menyinari kabut yang mengalir seperti samudera di antara Gunung Batok dan Semeru.',
                'highlights' => [
                    'Sunrise hangat dari spot tenang Bukit Kingkong',
                    'Jalan kaki atau naik kuda menembus Lautan Pasir',
                    'Melihat kawah aktif Bromo dari bibir kawah',
                    'Seduh kopi panas di hamparan Sabana Teletubbies',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Pulau Padar & Komodo Dragon Sanctuary',
                'slug' => 'pulau-padar-komodo-dragon-sanctuary',
                'region' => 'Bali & Nusa Tenggara',
                'location' => 'Labuan Bajo, Flores, NTT',
                'category' => 'Alam',
                'rating' => 4.95,
                'reviews_count' => 710,
                'price' => 4250000,
                'duration' => '3 Hari 2 Malam',
                'best_time' => 'April – November',
                'image' => 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Tiga teluk melengkung dengan warna pasir berbeda terlihat dari puncak Padar. Setelahnya, ranger lokal berseragam akan mendampingi kita berjalan pelan di Pulau Rinca melihat komodo di habitat alaminya, lalu santai berenang di pantai berpasir merah muda.',
                'highlights' => [
                    'Liveaboard menginap di kabin Phinisi kayu',
                    'Jalan pagi ke puncak Pulau Padar sebelum terik',
                    'Bertemu satwa purba komodo ditemani ranger taman nasional',
                    'Berenang santai di perairan jernih Pink Beach',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Pelataran Borobudur & Desa Menoreh',
                'slug' => 'pelataran-borobudur-desa-menoreh',
                'region' => 'Jawa',
                'location' => 'Magelang & Yogyakarta',
                'category' => 'Budaya',
                'rating' => 4.89,
                'reviews_count' => 960,
                'price' => 1250000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Sepanjang tahun (Pagi 05:30)',
                'image' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Mendengarkan kisah relief batu Borobudur dari kurator sejarah yang bertutur santai tanpa kaku. Dilanjutkan sarapan bubur gudeg hangat di pinggir sawah desa Menoreh dan keliling santai naik VW Safari klasik beratap terbuka.',
                'highlights' => [
                    'Akses pagi menaiki struktur candi bersama kurator lokal',
                    'Menyaksikan kabut Borobudur dari Bukit Rhema',
                    'Jalan santai di pedesaan asri Wanurejo & Karanganyar',
                    'Mencicipi kopi rempah dan mangut beong khas dusun',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Tebing Kelingking & Teluk Kristal',
                'slug' => 'tebing-kelingking-teluk-kristal',
                'region' => 'Bali & Nusa Tenggara',
                'location' => 'Nusa Penida, Klungkung, Bali',
                'category' => 'Pantai',
                'rating' => 4.92,
                'reviews_count' => 1140,
                'price' => 1850000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Maret – Oktober',
                'image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Dari atas tebing kapur hijau yang menjorok megah ke Samudera Hindia, deburan ombak terdengar jernih dari kejauhan. Trip dirancang tidak terburu-buru, ada waktu santai minum kelapa muda di Angel\'s Billabong dan snorkeling di Crystal Bay.',
                'highlights' => [
                    'Spot foto tebing T-Rex Kelingking saat cahaya sore',
                    'Snorkeling air tenang di teluk Crystal Bay',
                    'Menginap di pondok kayu dekat tebing Atuh',
                    'Menyusuri jalan setapak Broken Beach yang dramatis',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Lembah Bakkara & Danau Toba',
                'slug' => 'lembah-bakkara-danau-toba',
                'region' => 'Sumatera',
                'location' => 'Samosir, Sumatera Utara',
                'category' => 'Pegunungan',
                'rating' => 4.88,
                'reviews_count' => 355,
                'price' => 2650000,
                'duration' => '3 Hari 2 Malam',
                'best_time' => 'Mei – September',
                'image' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Udara sejuk pegunungan berpadu dengan ketenangan air danau vulkanik terbesar di Asia. Kita akan menyeberang ke Pulau Samosir, berkunjung ke rumah panggung Batak Huta Siallagan, dan mendengarkan alunan musik gondang tradisional di sore hari.',
                'highlights' => [
                    'Menyeberang danau menuju perkampungan kuno Batak Toba',
                    'Menatap bentang danau dari ketinggian Bukit Holbung',
                    'Singgah ke Air Terjun Sipiso-piso yang menjulang',
                    'Ngopi hangat Arabika Lintong bareng petani lokal',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Lolai Negeri di Atas Awan, Toraja',
                'slug' => 'lolai-negeri-di-atas-awan-toraja',
                'region' => 'Kalimantan & Sulawesi',
                'location' => 'Toraja Utara, Sulawesi Selatan',
                'category' => 'Budaya',
                'rating' => 4.90,
                'reviews_count' => 285,
                'price' => 3450000,
                'duration' => '4 Hari 3 Malam',
                'best_time' => 'Juni – Oktober',
                'image' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Dataran tinggi Toraja menyuguhkan ketenteraman yang berbeda. Di Lolai saat fajar menyingsing, kabut putih tebal berada tepat di bawah kaki kita. Rumah Tongkonan beratap perahu berdiri anggun di antara pohon bambu dan kebun kopi.',
                'highlights' => [
                    'Bangun pagi diiringi lautan awan tebal di Lolai',
                    'Belajar filosofi arsitektur Tongkonan di Kete Kesu',
                    'Ziarah budaya ke makam batu tebing Londa',
                    'Menikmati kopi Toraja asli yang baru disangrai',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Kawah Ijen & Blue Fire',
                'slug' => 'kawah-ijen-blue-fire',
                'region' => 'Jawa',
                'location' => 'Banyuwangi, Jawa Timur',
                'category' => 'Alam',
                'rating' => 4.93,
                'reviews_count' => 540,
                'price' => 1350000,
                'duration' => '2 Hari 1 Malam',
                'best_time' => 'Mei – Oktober',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Mendaki santai pada jam 2 dini hari dipandu bapak penambang lokal yang ramah. Di dasar kaldera, lidah api berwarna biru elektrik menyala dari celah bebatuan belerang, lalu disusul danau toska raksasa yang tampak anggun saat fajar.',
                'highlights' => [
                    'Menyaksikan api biru alami (Blue Fire) di dasar kawah',
                    'Pemandangan danau asam toska terluas di dunia',
                    'Didampingi pemandu lokal lengkap masker gas standar',
                    'Singgah sejenak ke Hutan De Djawatan yang rimbun',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Kepulauan Maratua & Danau Kakaban',
                'slug' => 'kepulauan-maratua-danau-kakaban',
                'region' => 'Kalimantan & Sulawesi',
                'location' => 'Berau, Kalimantan Timur',
                'category' => 'Pantai',
                'rating' => 4.94,
                'reviews_count' => 318,
                'price' => 4550000,
                'duration' => '4 Hari 3 Malam',
                'best_time' => 'Maret – Oktober',
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Berenang di danau air payau purba yang dipenuhi ribuan ubur-ubur jingga tanpa sengat adalah sensasi langka yang menenangkan. Menginap di cottage kayu tepi dermaga Maratua, di mana penyu laut sering berenang santai di bawah kamar kita.',
                'highlights' => [
                    'Berenang bebas bersama ubur-ubur jinak di Kakaban',
                    'Melihat anak penyu (tukik) di Pulau Sangalaki',
                    'Berenang di laguna air asin Gua Haji Mangku',
                    'Menginap di cottage terapung laut tenang Maratua',
                ],
                'is_featured' => true,
            ],
        ];

        foreach ($destinations as $dest) {
            Destination::updateOrCreate(['slug' => $dest['slug']], $dest);
        }

        // 2. Paket Wisata (Boutique & Slow Travel)
        $packages = [
            [
                'name' => 'Sailing Phinisi Labuan Bajo (Private Cabin)',
                'slug' => 'sailing-phinisi-labuan-bajo',
                'badge' => 'Pilihan Utama',
                'duration' => '3 Hari 2 Malam',
                'hotel' => 'Phinisi Woodcraft Cabin AC Privat',
                'price' => 4450000,
                'original_price' => 5100000,
                'facilities' => [
                    'Antar-jemput bandara Komodo langsung ke pelabuhan',
                    'Kabin AC bersih dengan kamar mandi dalam',
                    'Makan segar 7x disiapkan koki kapal (menu lokal & seafood)',
                    'Dokumentasi santai kamera & drone oleh tim lokal',
                    'Masker snorkeling, life jacket & izin ranger Komodo',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Overland Jawa Timur (Bromo, Ijen & Air Terjun)',
                'slug' => 'overland-jawa-timur',
                'badge' => 'Favorit Alam',
                'duration' => '4 Hari 3 Malam',
                'hotel' => 'Boutique Lodge & Glamping Asri',
                'price' => 2950000,
                'original_price' => 3450000,
                'facilities' => [
                    'Mobil privat ber-AC bersama driver lokal berpengalaman',
                    'Sewa Jeep 4x4 Bromo & masker gas respirator Ijen',
                    'Penginapan 3 malam termasuk sarapan hangat',
                    'Semua tiket masuk taman nasional & perizinan wisata',
                    'Pemandu lokal warga asli yang paham spot sepi',
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Slow Living Bali & Nusa Penida Escape',
                'slug' => 'slow-living-bali-nusa-penida',
                'badge' => 'Eksklusif Santai',
                'duration' => '5 Hari 4 Malam',
                'hotel' => 'Villa Kolam Renang Privat di Ubud & Sanur',
                'price' => 5750000,
                'original_price' => 6500000,
                'facilities' => [
                    '2 malam di Ubud view sawah + 2 malam di tepi pantai',
                    'Tiket kapal cepat PP Nusa Penida & mobil tur pulau',
                    'Makan malam santai seafood bakar tepi pantai Jimbaran',
                    'Sesi pijat relaksasi tradisional Bali 90 menit',
                    'Semua tiket destinasi & parkir tanpa pungutan lain',
                ],
                'is_featured' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            TourPackage::updateOrCreate(['slug' => $pkg['slug']], $pkg);
        }

        // 3. Galeri Foto Alam & Budaya
        $gallery = [
            [
                'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Pura Ulun Danu Beratan',
                'sub_title' => 'Kabut tipis pagi di atas Danau Beratan, Bedugul, Bali',
                'location' => 'Bali',
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Labirin Karst Piaynemo',
                'sub_title' => 'Sudut tenang Raja Ampat dipotret dari puncak kayu',
                'location' => 'Papua Barat Daya',
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Cahaya Pertama di Bromo',
                'sub_title' => 'Hawa dingin 10°C saat sang surya menyentuh pasir Tengger',
                'location' => 'Jawa Timur',
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?auto=format&fit=crop&w=1000&q=80',
                'title' => 'Senja di Perairan Komodo',
                'sub_title' => 'Siluet kapal Phinisi kayu berlabuh di Pulau Padar',
                'location' => 'Nusa Tenggara Timur',
            ],
        ];

        foreach ($gallery as $item) {
            GalleryItem::updateOrCreate(['title' => $item['title']], $item);
        }

        // 4. Testimoni Cerita Perjalanan Asli (Gaya Bahasa Manusiawi)
        $testimonials = [
            [
                'name' => 'Nadia Larasati',
                'role' => 'Jakarta • Perjalanan September 2026',
                'trip' => 'Sailing Phinisi Labuan Bajo',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=250&q=80',
                'comment' => 'Yang paling berkesan itu kapten dan kru kapalnya sopan dan perhatian banget. Waktu di Padar kita gak diburu-buru, bisa duduk lama nikmatin angin laut. Makanan di kapal dimasakin hangat-hangat tiap jam makan, ikannya segar.',
                'rating' => 5,
            ],
            [
                'name' => 'Dimas & Arini',
                'role' => 'Surabaya • Perjalanan Agustus 2026',
                'trip' => 'Raja Ampat Slow Trip',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=250&q=80',
                'comment' => 'Awalnya ragu bawa orang tua trip laut, tapi Mas Eko dari NusantaraWander sabar banget bantuin pas naik turun boat. Homestay-nya bersih, air tawarnya lancar, dan waktu snorkeling di Arborek benar-benar jernih kayak kolam kaca.',
                'rating' => 5,
            ],
            [
                'name' => 'Rizky Fadillah',
                'role' => 'Bandung • Perjalanan Oktober 2026',
                'trip' => 'Bromo & Kawah Ijen Private',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=250&q=80',
                'comment' => 'Driver Jeep di Bromo tahu spot rahasia yang sepi dari kerumunan turis lain, jadi foto-fotonya dapat latar savana yang bersih. Masker gas buat Ijen juga disediain yang tipe cartridge nyaman, gak sesak sama sekali.',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }

        // 5. Booking Sampel Nyata
        Booking::updateOrCreate(
            ['booking_code' => 'NW-88291'],
            [
                'item_name' => 'Sailing Phinisi Labuan Bajo (Private Cabin)',
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567890',
                'customer_email' => 'budi.santoso@gmail.com',
                'travel_date' => now()->addDays(12)->format('Y-m-d'),
                'pax' => 2,
                'addon_drone' => true,
                'addon_vip' => false,
                'promo_code' => 'PESONAID',
                'discount_amount' => 1402500,
                'total_price' => 7947500,
                'status' => 'confirmed',
                'notes' => 'Kabin non-smoking, makanan halal ramah anak',
            ]
        );
    }
}
