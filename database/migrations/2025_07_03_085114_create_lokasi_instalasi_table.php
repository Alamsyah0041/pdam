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
        Schema::create('lokasi_instalasi', function (Blueprint $table) {
    $table->id();
    $table->string('nama_instalasi');        
    $table->string('nama_jalan');            
    $table->decimal('latitude', 10, 7);       // Koordinat
    $table->decimal('longitude', 10, 7);      // Koordinat
    $table->text('keterangan')->nullable();  
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_instalasi');
    }
};
