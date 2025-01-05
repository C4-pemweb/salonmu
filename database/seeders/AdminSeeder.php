<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
        [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Gunakan hash untuk keamanan
            'role' => 'admin',
            'img_url' => null,
            'balance' => 0,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Hariono',
            'email' => 'hariono@gmail.com',
            'password' => Hash::make('password'), // Gunakan hash untuk keamanan
            'role' => 'employee',
            'img_url' => null,
            'balance' => 0,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    );
    }
}
