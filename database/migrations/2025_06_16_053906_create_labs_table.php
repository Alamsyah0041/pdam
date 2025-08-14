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
{
    Schema::create('lab', function (Blueprint $table) {
        $table->id();
        $table->string('ntu_nilai_bersih');
        $table->string('ntu_air_baku');
        $table->string('sisa_chlor');
        $table->string('ph');
        $table->timestamps();
    });
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labs');
    }
};
