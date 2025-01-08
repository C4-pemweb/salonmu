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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relate to the user who receives the notification
            $table->string('title'); // The title of the notification
            $table->text('message'); // The body or content of the notification
            $table->boolean('is_read')->default(false); // Whether the notification has been read or not
            $table->timestamps(); // created_at and updated_at columns
            // Optional: Foreign key to the users table if user_id is related to a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
