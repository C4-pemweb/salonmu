<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RoleSeeder::class, // Pastikan ini ada jika Anda membuat RoleSeeder
            BranchSeeder::class, // Tambahkan Seeder Anda di sini
            AdminSeeder::class
        ]);
    }
}
