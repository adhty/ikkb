<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // jabatan
            $table->string('photo')->nullable(); // path foto
            $table->enum('type', ['harian', 'komisi'])->default('harian');
            $table->foreignId('commission_id')->nullable()->constrained('commissions')->onDelete('set null');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
