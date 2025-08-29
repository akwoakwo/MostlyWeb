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
    }
}
