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
        Schema::create('imunisasi_perkembangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perkembangan_anak');
            $table->unsignedBigInteger('imunisasi_id');
            $table->timestamps();

            $table->foreign('id_perkembangan_anak')->references('id')->on('perkembangan_anak')->onDelete('cascade');
            $table->foreign('imunisasi_id')->references('id_imunisasi')->on('imunisasi')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imunisasi_perkembangan');
    }
};
