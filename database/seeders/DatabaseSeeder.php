<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\KnowledgeBase;
use App\Models\Assignment;
use App\Models\Solution;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA PENGGUNA
        $admin = User::create([
            'name' => 'Admin Violet Net',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $teknisi = User::create([
            'name' => 'Budi (Teknisi)',
            'email' => 'teknisi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'teknisi',
        ]);

        $pelanggan = User::create([
            'name' => 'Ibu Siti',
            'email' => 'pelanggan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
        ]);

        // 2. KATEGORI
        $cat1 = Category::create(['name' => 'Internet Mati', 'slug' => 'internet-mati', 'description' => 'Laporan terkait internet yang padam total']);
        $cat2 = Category::create(['name' => 'Wifi Lemot', 'slug' => 'wifi-lemot', 'description' => 'Masalah kecepatan internet yang menurun']);

        // 3. BASIS PENGETAHUAN (Bahasa Orang Tua)
        $kb1 = KnowledgeBase::create([
            'problem_title' => 'Lampu kotak wifi warna merah',
            'solution' => 'Bapak/Ibu jangan panik dulu. Coba matikan saklar listrik kotak wifi-nya, tunggu sebentar sambil hitung sampai 10, lalu nyalakan lagi. Kalau masih merah, coba cek kabel tipis warna kuning jangan sampai tertekuk ya.',
            'cleaned_text' => 'lampu kotak wifi warna merah',
            'keyword' => 'router, merah, mati',
            'is_verified' => true
        ]);

        $kb2 = KnowledgeBase::create([
            'problem_title' => 'Internet muter-muter (lemot)',
            'solution' => 'Coba dicek apakah cucu-cucu lagi main game atau lihat video banyak-banyak? Kalau iya, itu yang bikin berat. Coba jauhkan kotak wifi-nya dari tembok tebal atau lemari kayu supaya sinyalnya bisa lari kencang ke HP Ibu.',
            'cleaned_text' => 'internet muter lemot',
            'keyword' => 'lemot, lambat, wifi',
            'is_verified' => true
        ]);

    }
}
