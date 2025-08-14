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
        Schema::create('laporanharian', function (Blueprint $table) {
          $table->id();
            $table->string('nama');
            $table->float('debit_air'); // satuan liter/detik misalnya
            $table->float('tinggi_reservoard'); // satuan meter
            $table->string('status_pompa'); // contoh: Aktif / Nonaktif
            $table->string('frekuensi_pompa'); // contoh: 50Hz
            $table->string('pompa'); // nama atau kode pompa
            $table->text('keluhan')->nullable(); // opsional
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_harians');
    }
};
