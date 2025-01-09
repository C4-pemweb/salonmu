<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run()
    {
        DB::table('branches')->insert([
            [
                'name' => 'Cabang Utama Jakarta',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Pusat',
                'address' => 'Jl. Merdeka No. 1, Jakarta Pusat, DKI Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Bandung',
                'province' => 'Jawa Barat',
                'city' => 'Bandung',
                'address' => 'Jl. Diponegoro No. 5, Bandung, Jawa Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Surabaya',
                'province' => 'Jawa Timur',
                'city' => 'Surabaya',
                'address' => 'Jl. Tunjungan No. 10, Surabaya, Jawa Timur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Medan',
                'province' => 'Sumatera Utara',
                'city' => 'Medan',
                'address' => 'Jl. Gatot Subroto No. 12, Medan, Sumatera Utara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Yogyakarta',
                'province' => 'Yogyakarta',
                'city' => 'Yogyakarta',
                'address' => 'Jl. Malioboro No. 15, Yogyakarta, DI Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Semarang',
                'province' => 'Jawa Tengah',
                'city' => 'Semarang',
                'address' => 'Jl. Pemuda No. 8, Semarang, Jawa Tengah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Bali',
                'province' => 'Bali',
                'city' => 'Denpasar',
                'address' => 'Jl. Sunset Road No. 20, Denpasar, Bali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Makassar',
                'province' => 'Sulawesi Selatan',
                'city' => 'Makassar',
                'address' => 'Jl. Pantai Losari No. 18, Makassar, Sulawesi Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Batam',
                'province' => 'Kepulauan Riau',
                'city' => 'Batam',
                'address' => 'Jl. Raya Batam No. 25, Batam, Kepulauan Riau',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Banjarmasin',
                'province' => 'Kalimantan Selatan',
                'city' => 'Banjarmasin',
                'address' => 'Jl. A Yani No. 30, Banjarmasin, Kalimantan Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Palembang',
                'province' => 'Sumatera Selatan',
                'city' => 'Palembang',
                'address' => 'Jl. Sudirman No. 22, Palembang, Sumatera Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Pontianak',
                'province' => 'Kalimantan Barat',
                'city' => 'Pontianak',
                'address' => 'Jl. Alian No. 33, Pontianak, Kalimantan Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Solo',
                'province' => 'Jawa Tengah',
                'city' => 'Surakarta',
                'address' => 'Jl. Slamet Riyadi No. 40, Surakarta, Jawa Tengah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Aceh',
                'province' => 'Aceh',
                'city' => 'Banda Aceh',
                'address' => 'Jl. Teuku Umar No. 50, Banda Aceh, Aceh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabang Ambon',
                'province' => 'Maluku',
                'city' => 'Ambon',
                'address' => 'Jl. Merdeka No. 17, Ambon, Maluku',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
