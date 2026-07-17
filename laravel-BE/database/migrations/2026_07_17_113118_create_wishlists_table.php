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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users dengan cascade delete (jika user dihapus, wishlistnya ikut terhapus)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Relasi ke tabel books dengan cascade delete (jika buku dihapus, wishlist terkait ikut terhapus)
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->timestamps();

            // Mencegah duplikasi buku yang sama di dalam wishlist milik user yang sama
            $table->unique(['user_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
