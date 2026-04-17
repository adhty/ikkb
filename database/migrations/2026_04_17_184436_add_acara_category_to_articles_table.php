<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan raw SQL agar aman mengubah enum tanpa dependency tambahan
        DB::statement("ALTER TABLE articles MODIFY COLUMN category ENUM('berita', 'angket', 'acara') DEFAULT 'berita'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE articles MODIFY COLUMN category ENUM('berita', 'angket') DEFAULT 'berita'");
    }
};
