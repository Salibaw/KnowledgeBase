<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknisi Jaringan',
                'email' => 'teknisi@gmail.com',
                'password' => Hash::make('teknisi'),
                'role' => 'teknisi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelanggan Umum',
                'email' => 'pelanggan@gmail.com',
                'password' => Hash::make('pelanggan'),
                'role' => 'pelanggan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
