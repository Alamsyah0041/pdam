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
        Schema::create('lab', function (Blueprint $table) {
            $table->id();
            $table->decimal('ntu_air_bersih', 10, 2);  // untuk kolom ntu_air_bersih
            $table->decimal('reservoar', 10, 2);  // untuk kolom reservoar
            $table->decimal('ntu_air_baku', 10, 2);  // untuk kolom ntu_air_baku
            $table->decimal('sisa_chlor', 10, 2);  // untuk kolom sisa_chlor
            $table->decimal('ph_air', 5, 2);  // untuk kolom ph_air, dengan dua angka di belakang koma
            $table->timestamps();  // untuk kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab');
    }
};
