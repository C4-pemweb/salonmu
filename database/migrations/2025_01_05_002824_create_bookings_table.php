<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id'); // Kolom untuk ID layanan
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->unsignedBigInteger('employee_id'); // Relasi ke tabel users (sebagai employee)
            $table->date('date'); // Tanggal pemesanan
            $table->time('time'); // Waktu pemesanan
            $table->enum('status', ['selesai', 'pending', 'diterima',  'dibatalkan'])->default('pending');
            $table->timestamps();

             // Relasi foreign key
             $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
             $table->foreign('employee_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
             $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
