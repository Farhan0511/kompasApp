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
        Schema::create('master_alat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('kategori')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah')->default(1);
            $table->string('kondisi')->default('baik'); // baik, rusak, perbaikan
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_alat');
    }
};
