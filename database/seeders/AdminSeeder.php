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
                [
                    'name' => 'Admin User',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password'), // Use hash for security
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
                    'password' => Hash::make('password'), // Use hash for security
                    'role' => 'employee',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Super User',
                    'email' => 'super@gmail.com',
                    'password' => Hash::make('password'), // Use hash for security
                    'role' => 'superadmin',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Andi Wijaya',
                    'email' => 'andi@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'superadmin',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Budi Santoso',
                    'email' => 'budi@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Cynthia Lestari',
                    'email' => 'cynthia@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Diana Suryani',
                    'email' => 'diana@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Elena Rahayu',
                    'email' => 'elena@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Faisal Maulana',
                    'email' => 'faisal@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Gina Saputri',
                    'email' => 'gina@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Hadi Prasetyo',
                    'email' => 'hadi@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Indra Kusuma',
                    'email' => 'indra@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Jasmine Ria',
                    'email' => 'jasmine@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Kevin Pratama',
                    'email' => 'kevin@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Lina Ayu',
                    'email' => 'lina@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'img_url' => null,
                    'balance' => 0,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );        
    }
}
