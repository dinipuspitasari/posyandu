<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_posyandu', function (Blueprint $table) {
            $table->id('id_jadwal_posyandu'); // primary key dengan nama id_jadwal_posyandu
            $table->string('nama_kegiatan'); // Misalnya: Penimbangan Balita
            $table->date('tanggal');         // Tanggal kegiatan
            $table->time('waktu');           // Jam kegiatan
            $table->string('lokasi');        // Lokasi pelaksanaan
            $table->text('keterangan')->nullable(); // Opsional catatan tambahan
            $table->unsignedBigInteger('id_petugas'); // FK ke petugas
            // $table->id('id_petugas');
            $table->timestamps();

            // Foreign key ke tabel petugas
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandu');
    }
};
