<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([[
            "name"  => "admin",
            "phone" => "084134353122",
            "email" => "admin@gmail.com",
            "password" => Hash::make("12345"),
            "gambar" => "admin.jpg",
            "role" => "admin",
        ], [
            "name"  => "customer",
            "phone" => "083847086323",
            "email" => "customer@gmail.com",
            "password" => Hash::make("12345"),
            "gambar" => "admin.jpg",
            "role" => "customer",
        ]]);

        DB::table('pakets')->insert([[
            "nama_paket" => "Pribadi",
        ], [
            "nama_paket" => "Bisnis",
        ], [
            "nama_paket" => "Desain",
        ]]);

        DB::table('detail_pakets')->insert([[
            "paket_id" => 1,
            "nama_subpaket" => "Individu",
            "harga" => 225000,
            "benefit" => json_encode([
                "1 Halaman Website",
                "Landing Page Design",
                "Responsive Design",
                "Copy Writing",
                "Support 24/7",
                "Akses Dashboard Website",
                "Integrasi Media Sosial",
            ])
        ], [
            "paket_id" => 1,
            "nama_subpaket" => "Kelompok",
            "harga" => 500000,
            "benefit" => json_encode([
                "3 Halaman Website",
                "Landing Page Design",
                "Responsive Design",
                "Copy Writing",
                "Support 24/7",
                "Akses Dashboard Website",
                "Integrasi Media Sosial",
                "Fitur Google Maps",
                "Analytic Traffic",
            ])
        ], [
            "paket_id" => 1,
            "nama_subpaket" => "Komunitas",
            "harga" => 750000,
            "benefit" => json_encode([
                "5 Halaman Website",
                "Landing Page Design",
                "Responsive Design",
                "Free Logo Design",
                "Copy Writing",
                "Support 24/7",
                "Akses Dashboard Website",
                "Integrasi Media Sosial",
                "Fitur Google Maps",
                "Analytic Traffic",
                "Video Manual Penggunaan Website"
            ])
        ], [
            "paket_id" => 2,
            "nama_subpaket" => "Perintis",
            "harga" => 1300000,
            "benefit" => json_encode([
                "5 - 10 Halaman Website",
                "Free Domain (.com, .id, .co.id)",
                "Responsive Design",
                "Custom Web Design",
                "Copy Writing",
                "Free Logo Design",
                "Support 24/7",
                "Akses Dashboard Website",
                "Integrasi Media Sosial",
                "Katalog Produk",
                "Fitur Google Maps",
                "Analytic Traffic",
                "Video Manual Penggunaan Website"
            ])
        ], [
            "paket_id" => 2,
            "nama_subpaket" => "Regular",
            "harga" => 1825000,
            "benefit" => json_encode([
                "11 - 20 Halaman Website",
                "Free Domain (.com, .id, .co.id)",
                "Responsive Design",
                "Custom Web Design",
                "Copy Writing",
                "Free Logo Design",
                "Support 24/7",
                "Akses Dashboard Website",
                "Integrasi Media Sosial",
                "Katalog Produk",
                "Fitur Google Maps",
                "Analytic Traffic",
                "Video Manual Penggunaan Website"
            ])
        ], [
            "paket_id" => 2,
            "nama_subpaket" => "Profesional",
            "harga" => 3500000,
            "benefit" => json_encode([
                "21 - 35 Halaman Website",
                "Free Domain (.com, .id, .co.id)",
                "Shared Hosting",
                "Responsive Design",
                "Custom Web Design",
                "Copy Writing",
                "Free Logo Design",
                "Multi Bahasa (Indonesia & Inggris)",
                "Support 24/7",
                "Akses Dashboard Website",
                "Integrasi Media Sosial",
                "Katalog Produk",
                "Fitur Google Maps",
                "Analytic Traffic",
                "Video Manual Penggunaan Website"
            ])
        ], [
            "paket_id" => 3,
            "nama_subpaket" => "Desain Dasar",
            "harga" => 150000,
            "benefit" => json_encode([
                "1 - 3 Halaman Website",
                "Landing Page Design",
                "Responsive Design",
                "Copy Writing",
            ])
        ], [
            "paket_id" => 3,
            "nama_subpaket" => "Desain Menengah",
            "harga" => 350000,
            "benefit" => json_encode([
                "4 - 8 Halaman Website",
                "Landing Page Design",
                "Responsive Design",
                "Copy Writing",
            ])
        ], [
            "paket_id" => 3,
            "nama_subpaket" => "Desain Atas",
            "harga" => 600000,
            "benefit" => json_encode([
                "8 - 15 Halaman Website",
                "Landing Page Design",
                "Responsive Design",
                "Copy Writing",
                "Free Logo Design",
            ])
        ]]);

        DB::table('kategori_produks')->insert([[
            "nama_kategori"  => "Teknologi Digital",
        ], [
            "nama_kategori"  => "Otomotif",
        ],[
            "nama_kategori"  => "Lifestyle",
        ],[
            "nama_kategori"  => "Kesehatan",
        ],[
            "nama_kategori"  => "Pendidikan",
        ],[
            "nama_kategori"  => "Makanan & Minuman",
        ],[
            "nama_kategori"  => "Olahraga",
        ],[
            "nama_kategori"  => "Properti",
        ],[
            "nama_kategori"  => "Profil & Portofolio",
        ],[
            "nama_kategori"  => "Media Publikasi",
        ],[
            "nama_kategori"  => "Traveling",
        ]]);

        DB::table('produks')->insert([[
            "kategori_id" => 1,
            "nama_produk" => "Digital Store Website",
            "gambar_produk" => "sampul_digital.png",
            "fitur" => json_encode([
                "Home",
                "Katalog",
                "Kontak",
                "Profil",
                "Order",
            ])
            ],[
                "kategori_id" => 4,
                "nama_produk" => "Skincare Beauty Website",
                "gambar_produk" => "sampul_bakery.png",
                "fitur" => json_encode([
                    "Home",
                    "Katalog",
                    "Kontak",
                    "Profil",
                    "Order",
            ])
            ]]);

        DB::table('logos')->insert([[
            "nama_logo" => "Laravel",
            "gambar_logo" => "img/logo/laravel.png"
        ],[
            "nama_logo" => "Wordpress",
            "gambar_logo" => "img/logo/wordpress.png"
        ],[
            "nama_logo" => "HTML",
            "gambar_logo" => "img/logo/html.png"
        ],[
            "nama_logo" => "CSS",
            "gambar_logo" => "img/logo/css.png"
        ],[
            "nama_logo" => "JavaScript",
            "gambar_logo" => "img/logo/javascript.png"
        ],[
            "nama_logo" => "PHP",
            "gambar_logo" => "img/logo/php.png"
        ],[
            "nama_logo" => "Bootstrap",
            "gambar_logo" => "img/logo/bootstrap.png"
        ]]);

        DB::table('logo_produks')->insert([[
            "produk_id" => 1,
            "logo_id" => 2,
        ],[
            "produk_id" => 2,
            "logo_id" => 1,
        ],[
            "produk_id" => 2,
            "logo_id" => 3,
        ],[
            "produk_id" => 2,
            "logo_id" => 4,
        ]]);

        DB::table('preview_produks')->insert([[
            "produk_id" => 1,
            "gambar" => "preview-digital1.png",
        ],[
            "produk_id" => 1,
            "gambar" => "preview-digital2.png",
        ],[
            "produk_id" => 1,
            "gambar" => "preview-digital3.png",
        ]]);

        DB::table('faqs')->insert([[
            "pertanyaan" => "Berapa lama proses pembuatan website?",
            "jawaban" => "Rata-rata pembuatan website membutuhkan waktu antara 2 hingga 4 minggu, tergantung kompleksitas dan fitur yang diminta.",
        ],[
            "pertanyaan" => "Apakah website bisa diakses di semua perangkat?",
            "jawaban" => "Ya, semua website yang kami buat bersifat responsif sehingga dapat diakses dengan baik melalui komputer, tablet, maupun smartphone.",
        ],[
            "pertanyaan" => "Apakah ada layanan maintenance setelah website selesai dibuat?",
            "jawaban" => "Tentu, kami menyediakan layanan maintenance berkala sesuai dengan kebutuhan Anda.",
        ],[
            "pertanyaan" => "Apakah saya bisa melakukan kustomisasi desain website?",
            "jawaban" => "Ya, Anda bebas melakukan kustomisasi desain sesuai preferensi, kami akan membantu mewujudkan ide Anda.",
        ],[
            "pertanyaan" => "Apakah biaya sudah termasuk domain dan hosting?",
            "jawaban" => "Biaya pembuatan website sudah termasuk domain dan hosting tahun pertama, selanjutnya bisa diperpanjang sesuai kebutuhan.",
        ]]);

        DB::table('pemesanans')->insert([[
            "user_id" => 2,
            "subpaket_id" => 1,
            'produk_id' => 1,
            'catatan' => 'Web ini diperlukan cepat'
        ],[
            "user_id" => 2,
            "subpaket_id" => 2,
            'produk_id' => 1,
            'catatan' => '-'
        ],[
            "user_id" => 2,
            "subpaket_id" => 3,
            'produk_id' => 1,
            'catatan' => 'Desainnya menggunakan tema berwarna biru'
        ]]);

        DB::table('reviews')->insert([[
            "pemesanan_id" => 1,
            "user_id" => 2,
            'rating' => 3,
            'ulasan' => 'Harga terjangkau dengan kualitas website yang sangat bagus. Rekomendasi banget!'
        ],[
            "pemesanan_id" => 3,
            "user_id" => 2,
            'rating' => 5,
            'ulasan' => 'Website toko online saya jadi lebih profesional dan pelanggan semakin mudah berbelanja. Terima kasih!'
        ]]);
    }
}
