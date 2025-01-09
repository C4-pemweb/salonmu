<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'branch_id' => 1, // Jakarta branch
                'name' => 'Potong Rambut Pria',
                'description' => 'Potong rambut pria dengan gaya terkini dan profesional.',
                'price' => 100000,
                'duration' => 30, // 30 minutes
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 2, // Bandung branch
                'name' => 'Potong Rambut Wanita',
                'description' => 'Potong rambut wanita dengan model trendy dan sesuai bentuk wajah.',
                'price' => 150000,
                'duration' => 45, // 45 minutes
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 3, // Surabaya branch
                'name' => 'Perawatan Rambut Keratin',
                'description' => 'Perawatan keratin untuk rambut halus, lurus, dan berkilau.',
                'price' => 500000,
                'duration' => 90, // 1.5 hours
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 4, // Bali branch
                'name' => 'Cuci Rambut dan Pijat Kepala',
                'description' => 'Cuci rambut dengan sampo berkualitas dan pijat kepala untuk relaksasi.',
                'price' => 80000,
                'duration' => 30, // 30 minutes
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 5, // Yogyakarta branch
                'name' => 'Pewarnaan Rambut',
                'description' => 'Pewarnaan rambut dengan pilihan warna yang sesuai tren terbaru.',
                'price' => 350000,
                'duration' => 120, // 2 hours
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 6, // Semarang branch
                'name' => 'Facial Pembersihan Wajah',
                'description' => 'Facial untuk membersihkan kulit wajah dari kotoran dan minyak berlebih.',
                'price' => 200000,
                'duration' => 60, // 1 hour
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 7, // Makassar branch
                'name' => 'Perawatan Wajah Anti-Aging',
                'description' => 'Perawatan wajah untuk mengurangi tanda-tanda penuaan dan memperbaiki elastisitas kulit.',
                'price' => 600000,
                'duration' => 90, // 1.5 hours
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 8, // Batam branch
                'name' => 'Manikur dan Pedikur',
                'description' => 'Perawatan kuku tangan dan kaki dengan hasil yang rapi dan elegan.',
                'price' => 150000,
                'duration' => 60, // 1 hour
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 9, // Banjarmasin branch
                'name' => 'Pijat Relaksasi Punggung',
                'description' => 'Pijat relaksasi punggung untuk mengurangi ketegangan otot dan meningkatkan sirkulasi darah.',
                'price' => 120000,
                'duration' => 45, // 45 minutes
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 10, // Palembang branch
                'name' => 'Lash Lift',
                'description' => 'Lash lift untuk melentikkan bulu mata tanpa perlu mascara.',
                'price' => 250000,
                'duration' => 60, // 1 hour
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 11, // Pontianak branch
                'name' => 'Hair Spa',
                'description' => 'Perawatan rambut dengan masker dan pemijatan kepala untuk menutrisi dan menenangkan rambut.',
                'price' => 400000,
                'duration' => 90, // 1.5 hours
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 12, // Solo branch
                'name' => 'Pemotongan Rambut Anak',
                'description' => 'Potong rambut untuk anak-anak dengan cara yang menyenangkan dan cepat.',
                'price' => 80000,
                'duration' => 30, // 30 minutes
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 13, // Aceh branch
                'name' => 'Perawatan Rambut Kering dan Rusak',
                'description' => 'Perawatan khusus untuk rambut kering dan rusak agar menjadi lebih sehat dan berkilau.',
                'price' => 400000,
                'duration' => 90, // 1.5 hours
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 14, // Ambon branch
                'name' => 'Brazilian Waxing',
                'description' => 'Perawatan waxing untuk area bikini dengan teknik cepat dan minim rasa sakit.',
                'price' => 250000,
                'duration' => 45, // 45 minutes
                'img_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
