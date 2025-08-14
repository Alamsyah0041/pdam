<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('rekapitulasis', function (Blueprint $table) {
        $table->id();
        $table->dateTime('waktu'); // waktu laporan
        $table->string('shift')->nullable(); // shift pagi/siang/malam

        // ====== DATA OPERATOR ======
        $table->integer('ipa1')->nullable();
        $table->integer('ipa2')->nullable();
        $table->integer('ipa4')->nullable();

        $table->string('resv1')->nullable();
        $table->string('resv2')->nullable();
        $table->string('resv3')->nullable();

        // Pompa-pompa (status, freq, debit)
        for ($i = 1; $i <= 6; $i++) {
            $table->string("pompa{$i}_status")->nullable();
            $table->string("pompa{$i}_freq")->nullable();
            $table->string("pompa{$i}_debit")->nullable();
        }

    
        $table->string('acp')->nullable();   // ex: Flowmeter Error / 2.7
        $table->string('grp')->nullable();   // ex: 54 / 3.0
       

        // ====== DATA LAB ======
        $table->string('ntu_r1')->nullable();
        $table->string('ntu_r2')->nullable();
        $table->string('ntu_r3')->nullable();

        $table->string('ntu_bk2')->nullable();
        $table->string('ntu_bk4')->nullable();

        $table->string('chlor_r1')->nullable();
        $table->string('chlor_r2')->nullable();
        $table->string('chlor_r3')->nullable();

        $table->string('ph_r1')->nullable();
        $table->string('ph_r2')->nullable();
        $table->string('ph_r3')->nullable();

        // Catatan/keterangan
        $table->text('catatan')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasis');
    }
};
