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
        Schema::create('operator', function (Blueprint $table) {
            $table->id();
            $table->decimal('debit_air', 10, 2);  // untuk kolom debit_air
            $table->decimal('tinggi_reservoir', 10, 2);  // untuk kolom tinggi_reservoir
            $table->string('status_pompa', 50);  // untuk kolom status_pompa
            $table->decimal('frequensi_pompa', 10, 2);  // untuk kolom frequensi_pompa
            $table->boolean('pompa_acp');  // untuk kolom pompa_acp
            $table->boolean('pompa_grp');  // untuk kolom pompa_grp
            $table->text('keluhan')->nullable();  // untuk kolom keluhan, nullable jika tidak ada keluhan
            $table->timestamps();  // untuk kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator');
    }
};
