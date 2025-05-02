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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->string('title')->unique();  // Judul kursus
            $table->text('description');  // Deskripsi kursus
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');  // Relasi ke tabel Users (instruktur)
            $table->string('category');  // Kategori kursus
            $table->decimal('price', 10, 2)->nullable();  // Harga kursus (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
