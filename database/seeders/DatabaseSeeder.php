<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'status' => 1,
            'hp' => '081234567890',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama' => 'Admin Kedai',
            'email' 
            => 'admin2@gmail.com',
            'role' => 0,
            'status' => 1,
            'hp' => '081234567891',
            'password' => bcrypt('P@55word'),
        ]);
    }
}